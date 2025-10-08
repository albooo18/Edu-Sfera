<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()->with(['participants', 'messages'])->get();
        return view('messages.index', compact('conversations'));
    }

    public function show($conversationId)
    {
        // Ensure the current user is a participant in the conversation
        $conversation = Conversation::with(['participants', 'messages'])
            ->whereHas('participants', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($conversationId);

        return view('messages.show', compact('conversation'));
    }

    public function createConversation($friendId)
    {
        \Log::info('Creating conversation for friend:', ['friendId' => $friendId]); // Debugging
        $friend = User::findOrFail($friendId);

        $conversation = Conversation::whereHas('participants', function ($query) use ($friendId) {
            $query->where('user_id', Auth::id());
        })->whereHas('participants', function ($query) use ($friendId) {
            $query->where('user_id', $friendId);
        })->with('messages.sender')->first();

        if (!$conversation) {
            $conversation = Conversation::create();
            $conversation->participants()->create(['user_id' => Auth::id()]);
            $conversation->participants()->create(['user_id' => $friend->id]);
        }

        return response()->json([
            'conversation' => $conversation,
            'messages' => $conversation->messages
        ]);
    }

    public function store(Request $request, $conversationId)
    {
        $request->validate(['message' => 'required|string']);
    
        // Ensure the user is a participant in the conversation
        $conversation = Conversation::findOrFail($conversationId);
        if (!$conversation->participants()->where('user_id', Auth::id())->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Save the message
        $message = new Message([
            'conversation_id' => $conversationId,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);
        $message->save();
    
        // Log the event
        \Log::info('Broadcasting MessageSent event', ['message' => $message]);
    
        // Broadcast the event
        broadcast(new MessageSent($message))->toOthers();
    
        // Return the message with sender details
        return response()->json([
            'message' => $message->load('sender'),
        ]);
    }
    
}

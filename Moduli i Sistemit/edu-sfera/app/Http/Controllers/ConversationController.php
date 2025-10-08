<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = auth()->user()->conversations()->with('partner', 'messages')->get();

        return view('conversations.index', compact('conversations'));
    }

    public function startConversation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $authUser = Auth::user();
        $friendId = $request->user_id;

        // Ensure they are friends
        if (!$authUser->friends()->where('id', $friendId)->exists()) {
            return redirect()->back()->with('error', 'You can only message friends.');
        }

        // Check if a conversation already exists
        $conversation = Conversation::whereHas('participants', function ($query) use ($authUser, $friendId) {
            $query->whereIn('user_id', [$authUser->id, $friendId]);
        }, '=', 2)->first();

        if (!$conversation) {
            $conversation = Conversation::create(['type' => 'private']);

            // Add participants
            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $authUser->id,
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $friendId,
            ]);
        }

        return redirect()->route('conversations.show', $conversation->id);
    }

    public function show($conversationId) {
        $conversation = Conversation::with(['messages.sender'])
            ->whereHas('participants', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($conversationId);
    
        return response()->json($conversation->messages);
    }
}

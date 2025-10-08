<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {
    public function index() {
        $users = User::where('id', '!=', Auth::id())->get();
        $sentRequests = Auth::user()->sentRequests()->where('status', 'pending')->get();
        $receivedRequests = Auth::user()->receivedRequests()->where('status', 'pending')->get();

        return view('friends.index', compact('users', 'sentRequests', 'receivedRequests'));
    }

    public function sendRequest(User $user) {
        if (!FriendRequest::where('sender_id', Auth::id())->where('receiver_id', $user->id)->exists()) {
            FriendRequest::create(['sender_id' => Auth::id(), 'receiver_id' => $user->id]);
        }
        return back();
    }

    public function cancelRequest(User $user) {
        FriendRequest::where('sender_id', Auth::id())->where('receiver_id', $user->id)->delete();
        return back();
    }

    public function acceptRequest(User $user) {
        FriendRequest::where('receiver_id', Auth::id())
            ->where('sender_id', $user->id)
            ->update(['status' => 'accepted']);
        return back();
    }

    public function declineRequest(User $user) {
        FriendRequest::where('receiver_id', Auth::id())
            ->where('sender_id', $user->id)
            ->delete();
        return back();
    }

    
}

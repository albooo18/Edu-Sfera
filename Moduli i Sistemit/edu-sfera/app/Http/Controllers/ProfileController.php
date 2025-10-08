<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Fetch the user's posts
        $posts = $user->posts()->latest()->paginate(10);

        // Fetch the user's friends
        $friends = auth()->user()->friends();
        // Count the number of posts and friends
        $postCount = $user->posts()->count();

        $friendCount = $friends->count();

        return view('profile.profile', compact('user', 'posts', 'friends', 'postCount', 'friendCount'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $originalName);
            $user->img = 'images/' . $originalName;
        }

        // Update other profile fields
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->uni = $request->input('uni');
        $user->location = $request->input('location');

        $user->save();

        return response()->json(['message' => 'Profile updated successfully.']);
    }

    public function removeFriend(Request $request, $friendId)
    {
        $user = auth()->user();

        // Find the friend request
        $friendRequest = FriendRequest::where(function ($query) use ($user, $friendId) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($user, $friendId) {
            $query->where('sender_id', $friendId)
                ->where('receiver_id', $user->id);
        })->first();

        // Delete the friend request (remove the friendship)
        if ($friendRequest) {
            $friendRequest->delete();
            return redirect()->back()->with('success', 'Friend removed successfully.');
        }

        return redirect()->back()->with('error', 'Friend not found.');
    }

    public function show($userId)
    {
        $user = DB::table('users')->where('id', $userId)->first();

        // Fetch friends (union query)
        $friends = DB::table('users')
        ->join('friend_requests', 'users.id', '=', 'friend_requests.receiver_id')
        ->where('friend_requests.sender_id', $userId)
        ->where('friend_requests.status', 'accepted')
        ->select('users.id as user_id', 'users.name', 'users.email', 'users.img', 'users.surname', 'users.uni') // Include img, surname, and uni
        ->union(
            DB::table('users')
                ->join('friend_requests', 'users.id', '=', 'friend_requests.sender_id')
                ->where('friend_requests.receiver_id', $userId)
                ->where('friend_requests.status', 'accepted')
                ->select('users.id as user_id', 'users.name', 'users.email', 'users.img', 'users.surname', 'users.uni') // Include img, surname, and uni
        )
        ->get();

        $friendCount = DB::table('friend_requests')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->where('status', 'accepted')
            ->count();

        $posts = DB::table('posts')->where('userId', $userId)->latest()->paginate(10);

        $postCount = DB::table('posts')->where('userId', $userId)->count();

        // Return the view with user and friends data
        return view('profile.show', compact('user', 'friends', 'friendCount', 'postCount', 'posts'));
    }
}



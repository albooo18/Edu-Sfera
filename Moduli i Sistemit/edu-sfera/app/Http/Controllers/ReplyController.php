<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:replies,id',
        ]);

        $reply = new Reply();
        $reply->content = $validated['content'];
        $reply->post_id = $validated['post_id'];
        $reply->parent_id = $validated['parent_id'];
        $reply->user_id = auth()->id();
        $reply->save();

        return back()->with('success', 'Reply posted successfully');
    }
}

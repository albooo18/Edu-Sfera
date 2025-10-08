<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 


class PostController extends Controller
{
    protected $guarded = [];

    // public function create()
    // {
    //     return view('posts.create');
    // }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tags' => 'required|string',
        ]);

        $slug = Str::slug($request->title, '-');


        $count = Post::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1); 
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug, // Add the slug
            'userId' => auth()->id(),
        ]);

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);

        return redirect()->route('posts.show', $post->slug)->with('success', 'Post created successfully!');
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with(['user', 'replies.user','replies.replies.user'])
            ->firstOrFail();

        $post->increment('views');

        return view('posts.show', compact('post'));
    }


    public function storeReply(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:replies,id', // Validate parent_id if provided
        ]);

        

        $post->replies()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id, // Store parent_id if present
        ]);

        $post->increment('replies_count');


        return back();
    }

    public function vote(Request $request, Post $post)
    {
        $request->validate([
            'vote' => 'required|in:up,down'
        ]);

        $user = auth()->user();
        $existingVote = $post->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            if ($existingVote->vote === $request->vote) {
                $existingVote->delete();
            } else {
                $existingVote->update(['vote' => $request->vote]);
            }
        } else {
            $post->votes()->create([
                'user_id' => $user->id,
                'vote' => $request->vote
            ]);
        }

        return back();
    }


    public function destroy(Post $post)
    {
        if ($post->userId !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }
    
        $post->delete();
    
        return redirect('/');
    }

    public function edit(Post $post)
    {
        if ($post->userId !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }
    
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
{
    // Ensure the authenticated user is the owner of the post
    if ($post->userId !== auth()->id()) {
        return redirect()->back()->with('error', 'You are not authorized to edit this post.');
    }

    // Validate the request data
    $request->validate([
        'title' => 'required',
        'body' => 'required',
        'tags' => 'required|string',
    ]);

    // Update the post
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    // Process tags
    $tags = explode(',', $request->tags);
    $tagIds = [];

    foreach ($tags as $tagName) {
        $tagName = trim($tagName);
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $tagIds[] = $tag->id;
    }

    // Sync tags with the post
    $post->tags()->sync($tagIds);

    return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully!');
}

}

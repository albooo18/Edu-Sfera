<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str; 


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Start building the query for filtered posts
        $query = Post::with(['user', 'tags'])
            ->withCount('votes')
            ->latest();

        // Filter by title and tags if search input is provided
        if ($search) {
            // Extract tags from the search input (e.g., #tag1 #tag2)
            $tags = [];
            $title = '';
            $terms = explode(' ', $search);

            foreach ($terms as $term) {
                if (Str::startsWith($term, '#')) {
                    // This is a tag
                    $tags[] = Str::substr($term, 1); // Remove the '#' prefix
                } else {
                    // This is part of the title
                    $title .= $term . ' ';
                }
            }

            $title = trim($title);

            // Filter by title
            if (!empty($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }

            // Filter by tags
            if (!empty($tags)) {
                $query->whereHas('tags', function ($q) use ($tags) {
                    $q->whereIn('name', $tags);
                });
            }
        }

        // Paginate the filtered results
        $posts = $query->paginate(10);

        // Fetch the most viewed posts
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(5)->get();

        // Fetch the most voted posts
        $mostVotedPosts = Post::withCount(['votes as total_votes' => function ($query) {
            $query->selectRaw('SUM(CASE WHEN vote = "up" THEN 1 ELSE -1 END)');
        }])
        ->orderBy('total_votes', 'desc')
        ->take(5)
        ->get();

        return view('home', compact('posts', 'mostViewedPosts', 'mostVotedPosts'));
    }

    
    public function getPost()
    {
        return view('posts.show');
    }
}
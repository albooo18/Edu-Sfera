<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 tags
        $tags = Tag::factory()->count(10)->create();

        // Create 20 posts and attach tags
        Post::factory()->count(20)->create()->each(function ($post) use ($tags) {
            $randomTags = $tags->random(rand(1, 4))->pluck('id'); // Attach 1 to 4 random tags
            $post->tags()->attach($randomTags);
        });
    }
}

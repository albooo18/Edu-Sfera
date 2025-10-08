<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;
use App\Models\Vote;

class Post extends Model
{   
    use HasFactory;
    protected $guarded = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Count the number of upvotes
    public function upvotesCount()
    {
        return $this->votes()->where('vote', 'up')->count();
    }
    
    // Count the number of downvotes
    public function downvotesCount()
    {
        return $this->votes()->where('vote', 'down')->count();
    }

    // Get the vote made by the current user
    public function userVote()
    {
        return $this->hasOne(Vote::class)->where('user_id', auth()->id());
    }

    // Calculate the total votes (upvotes - downvotes)
    public function totalVotes()
    {
        return $this->upvotesCount() - $this->downvotesCount();
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            // Delete related tags
            $post->tags()->detach();

            // Delete related replies
            $post->replies()->delete();
        });
    }
}

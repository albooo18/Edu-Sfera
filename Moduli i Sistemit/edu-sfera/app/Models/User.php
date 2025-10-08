<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $attributes = [
        'img' => 'default.jpg',
    ];



    public function sentRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friends()
    {
        return User::whereIn('id', function ($query) {
            $query->select('receiver_id')
                ->from('friend_requests')
                ->where('sender_id', $this->id)
                ->where('status', 'accepted')
                ->union(
                    DB::table('friend_requests')
                        ->select('sender_id')
                        ->where('receiver_id', $this->id)
                        ->where('status', 'accepted')
                );
        })->get();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'userId');
    }


    public function conversations()
    {
        return $this->hasManyThrough(Conversation::class, ConversationParticipant::class, 'user_id', 'id', 'id', 'conversation_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }



    public function setPostTitle($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }


}

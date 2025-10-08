<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;
use App\Http\Controllers\QuizController;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/posts/{post}/replies', [PostController::class, 'storeReply'])->middleware('auth')->name('posts.reply');
Route::post('/posts/{post}/vote', [PostController::class, 'vote'])->middleware('auth')->name('posts.vote');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth')->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth')->name('posts.update');
Route::delete('/profile/remove-friend/{friendId}', [ProfileController::class, 'removeFriend'])->middleware('auth')->name('profile.remove-friend');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionUserController::class, 'create'])->name('login');
Route::post('/login', [SessionUserController::class, 'store']);
Route::post('/logout', [SessionUserController::class, 'destroy']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.profile');
Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.list');
    Route::post('/send-request/{user}', [FriendController::class, 'sendRequest'])->name('friends.send');
    Route::delete('/friends/remove/{friend_id}', function ($friend_id) {
        $deleted = DB::table('friend_requests')
            ->where(function ($query) use ($friend_id) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $friend_id);
            })
            ->orWhere(function ($query) use ($friend_id) {
                $query->where('sender_id', $friend_id)
                    ->where('receiver_id', auth()->id());
            })
            ->where('status', 'accepted')
            ->delete();

        if ($deleted) {
            return back()->with('success', 'Friend removed successfully.');
        } else {
            return back()->with('error', 'Friendship not found.');
        }
    })->name('friends.remove');
    Route::post('/cancel-request/{user}', [FriendController::class, 'cancelRequest'])->name('friends.cancel');
    Route::post('/accept-request/{user}', [FriendController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/decline-request/{user}', [FriendController::class, 'declineRequest'])->name('friends.decline');

    // Conversations

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{conversationId}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/store/{conversationId}', [MessageController::class, 'store'])->name('messages.store');
    Route::match(['get', 'post'], '/messages/create/{friendId}', [MessageController::class, 'createConversation'])->name('messages.create');
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->middleware('auth');
    Route::post('/pusher/auth', function (Request $request) {
        Log::info('Pusher authentication request:', [
            'channel_name' => $request->channel_name,
            'socket_id' => $request->socket_id,
        ]);
        return Broadcast::auth($request);
    })->middleware('web');


    Route::prefix('quizzes')->group(function () {
        Route::get('/progress', [QuizController::class, 'progress'])->name('quizzes.progress')->middleware('auth'); // Specific route first
        Route::get('/category/{category}', [QuizController::class, 'showByCategory'])->name('quizzes.category'); // Category route
        Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quizzes.show'); // Quiz route
        Route::get('/', [QuizController::class, 'index'])->name('quizzes.index'); // List all quiz categories
        Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    });
});


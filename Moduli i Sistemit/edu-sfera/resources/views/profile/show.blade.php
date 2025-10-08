@php
    $gradients = [
        'from-red-500 to-yellow-500',
        'from-blue-500 to-green-500',
        'from-purple-500 to-pink-500',
        'from-cyan-500 to-indigo-500',
        'from-gray-700 to-gray-900',
    ];
    $randomGradient = $gradients[array_rand($gradients)];

    $isFriend = DB::table('friend_requests')
        ->where(function ($query) use ($user) {
            $query
                ->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id)
                ->where('status', 'accepted');
        })
        ->orWhere(function ($query) use ($user) {
            $query
                ->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('status', 'accepted');
        })
        ->exists();

    $isPending = DB::table('friend_requests')
        ->where(function ($query) use ($user) {
            $query
                ->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id)
                ->where('status', 'pending');
        })
        ->orWhere(function ($query) use ($user) {
            $query
                ->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('status', 'pending');
        })
        ->exists();
@endphp

<x-layout>
    <div class="w-screen flex justify-center text-white">
        <div
            class="h-[300px] w-[100vw] z-[-2] absolute bg-gradient-to-r {{ $randomGradient }} flex justify-end items-end">

        </div>

        <div
            class="w-full mt-[150px] h-fit max-w-4xl bg-slate-600 rounded-xl p-8 flex flex-col items-center justify-center shadow-center shadow-black/50 relative group">
            @if (auth()->id() === $user->id)
                <button id="edit-btn" title="Edit"
                    class="absolute right-5 top-5 text-gray-300/70 text-xl hover:text-gray-50 hover:scale-125 transition-all invisible group-hover:visible">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            @endif
            @if (auth()->id() !== $user->id)
                @if (!$isFriend && !$isPending)
                    <form action="{{ route('friends.send', $user->id) }}" method="POST" class="mt-4 z-50 absolute left-5 top-0">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 cursor-pointer z-50">
                            Shto si shok
                        </button>
                    </form>
                @elseif ($isPending)
                    <div class="mt-4 text-gray-300 z-50">
                        Ju keni derguar kerkesen per shoqeri
                    </div>
                @else
                    <div class="mt-4 text-gray-300 z-50">
                        Ju jeni shok.
                    </div>
                @endif
            @endif

            <div class="relative">
                <img src="{{ asset($user->img) }}" id="profile-image"
                    class="rounded-full object-fit border-dashed w-[250px] h-[250px]" height="250px" width="250px"
                    alt="Profile Image">
            </div>

            <div class="flex flex-col w-full items-center justify-center gap-8">
                <div class="flex">
                    <h1 class="text-5xl py-5 px-2 font-extrabold rounded-xl capitalize">{{ $user->name }}</h1>
                    <h1 class="text-5xl py-5 px-2 font-extrabold rounded-xl capitalize">{{ $user->surname }}</h1>
                </div>

                <x-split-style>
                    <x-slot:heading-1>
                        <i class="fas fa-graduation-cap"></i>
                        <div class="text-3xl rounded-xl p-2">
                            {{ $user->uni }}
                        </div>
                    </x-slot:heading-1>
                    <x-slot:heading-2>
                        <i class="fas fa-map-pin"></i>
                        <h5 class="text-3xl rounded-xl p-2">{{ $user->location }}</h5>
                    </x-slot:heading-2>
                </x-split-style>

                <div class="mx-10 h-[1px] w-96 bg-gray-50/30"></div>
                <div class="flex gap-10">
                    <div class="flex flex-col items-center justify-center">
                        <h3 class="font-bold text-7xl">{{ $friendCount }}</h3>
                        <span>Friends</span>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <h3 class="font-bold text-7xl">{{ $postCount }}</h3>
                        <span>Posts</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display User's Posts -->
    <div class="w-screen flex justify-center mt-8">
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-4">Posts</h2>
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="bg-slate-600 p-4 rounded-md shadow-md mb-4">
                        <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                        <p class="text-gray-300">{{ Str::limit($post->body, 200) }}</p>
                    </div>
                @endforeach
                {{ $posts->links() }} <!-- Pagination Links -->
            @else
                <p class="text-gray-300">No posts yet.</p>
            @endif
        </div>
    </div>

    <!-- Display User's Friends -->
    <div class="w-screen flex justify-center mt-8">
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-4">Friends</h2>
            @if ($friends->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($friends as $friend)
                        <div class="bg-slate-600 p-4 rounded-md shadow-md">
                            <div class="flex items-center">
                                <img src="{{ asset($friend->img) }}" class="w-10 h-10 rounded-full mr-3"
                                    alt="{{ $friend->name }}">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $friend->name }} {{ $friend->surname }}</h3>
                                    <p class="text-sm text-gray-300">{{ $friend->uni }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-300">No friends yet.</p>
            @endif
        </div>
    </div>
</x-layout>

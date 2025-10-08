<x-layout>
    <div class="container mx-auto flex items-center gap-10">
        @auth
            <form action="{{ route('posts.vote', $post) }}" method="POST"
                class="flex flex-col justify-center items-center font-bold text-3xl text-gray-300">
                @csrf
                <button type="submit" name="vote" value="up"
                    class="text-slate-400 text-5xl hover:text-green-700 transition-colors duration-150" title="Up vote">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <p>{{ $post->upvotesCount() }} </p>
                <div class="h-[1px] my-5 bg-gray-500/50 w-full"></div>
                <p>{{ $post->downvotesCount() }} </p>
                <button type="submit" name="vote" value="down"
                    class="text-gray-400 text-5xl hover:text-red-700 transition-colors duration-150" title="Down vote">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </form>
        @else
            <form action="{{ route('posts.vote', $post) }}" method="POST"
                class="flex flex-col justify-center items-center font-bold text-3xl text-gray-300">
                @csrf
                <button type="submit" name="vote" value="up"
                    class="text-slate-400 text-5xl hover:text-green-700 transition-colors duration-150" title="Up vote">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <p>{{ $post->upvotesCount() }} </p>
                <div class="h-[1px] my-5 bg-gray-500/50 w-full"></div>
                <p>{{ $post->downvotesCount() }} </p>
                <button type="submit" name="vote" value="down"
                    class="text-gray-400 text-5xl hover:text-red-700 transition-colors duration-150" title="Down vote">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </form>
        @endauth

        <div class="w-full">
            <div class="text-white p-6 border-b-2 border-gray-500/50 w-full">
                <div class="flex justify-between">

                    <h1 class="text-3xl font-bold ">{{ $post->title }}

                    </h1>
                    <div class=" text-gray-100 font-bold">
                        @if ($post->user->id !== auth()->id())
                            <a href="{{ route('profile.show', $post->user->id) }}" class="flex items-center gap-5">
                                <x-school-tag>{{ $post->user->uni }}</x-school-tag>
                                <img src="{{ asset($post->user->img) }}"  alt="" class="w-10 h-10 rounded-full mr-3">
                                <p>Nga {{ $post->user->name }} {{ $post->user->surname }} |
                                    {{ $post->created_at->diffForHumans() }}</p>
                            </a>
                        @else
                            <a href="{{ route('profile.profile') }}" class="flex items-center gap-5">
                                <x-school-tag>{{ $post->user->uni }}</x-school-tag>
                                <img src="{{ asset($post->user->img) }}" alt="User Profile Picture"
                                    class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <span class="font-bold">{{ $post->user->name }}</span>
                                    <p class="text-sm text-gray-300">{{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endif

                    </div>
                </div>



                <div class="my-4 border-t py-4">
                    <p class="text-lg">{{ $post->body }} @if (auth()->check() && $post->userId === auth()->id())
                            <div class="flex items-center">
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="alert('Ju fshite postin !')"
                                        class="px-4 py-2 text-xl bg-transperent text-white rounded hover:bg-red-700">Fshi
                                        <i class="fa-solid fa-trash-can text-red-500"></i>
                                    </button>
                                </form>
                                <div class="mt-4">
                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="px-4 py-2 bg-transperent text-xl text-white rounded hover:bg-yellow-700">Modifiko
                                        <i class="fa-solid fa-pencil text-yellow-500"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </p>
                </div>



                <div class="tags mb-4 flex items-center">
                    @foreach ($post->tags as $tag)
                        <span class="bg-slate-500 text-white text-sm px-3 py-1 rounded-full mr-2"># <span
                                class="font-semibold text-base">{{ $tag->name }}</span></span>
                    @endforeach
                </div>






            </div>



            <div class="p-5 mt-2 text-white">
                <div class="mt-4">
                    <strong>{{ $post->replies->count() }} Pergjigjet</strong>
                </div>

                @auth
                    <form action="{{ route('posts.reply', $post) }}" method="POST" class="mt-3">
                        @csrf
                        <textarea name="body"
                            class="outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-2 border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-800 dark:focus:border-blue-800 shadow-2xl"
                            rows="7" placeholder="Shkruaj nje pergjigje" required></textarea>
                        <button type="submit"
                            class="px-4 py-2 my-5 bg-gray-600 font-semibold shadow-2xl text-white rounded hover:bg-slate-800 transition-all duration-200">Pergjigju</button>
                    </form>
                @endauth

                @php
                    function displayReplies($replies, $level = 0)
                    {
                        foreach ($replies as $reply) {
                            $indent = $level * 35; // 20px indent per level
                            $hasReplies = $reply->replies->isNotEmpty();
                            echo '<div class="border-b border-gray-200/50 py-10 last:border-0 reply-container" style="margin-left: ' .
                                $indent .
                                'px;">';
                            echo '<p class="my-2 text-2xl">' . $reply->body . '</p>';
   
                                    
                            echo '<small class="opacity-60">Nga <x-school-tag></x-school-tag> <strong>' .
                                $reply->user->name .
                                ' ' .
                                $reply->user->surname .
                                '</strong> at ' .
                                $reply->created_at->format('d M Y, H:i') .
                                '</small>';

                            if ($reply->parent_id) {
                                $parent = $reply->parent()->first();
                                if ($parent) {
                                    echo '<small class="block opacity-60">In reply to ' .
                                        $parent->user->name .
                                        ' ' .
                                        $parent->user->surname .
                                        '</small>';
                                }
                            }

                            echo '<div class="mt-2 flex gap-2">';
                            if (auth()->check()) {
                                // Reply button
                                echo '<button class="show-reply-form text-blue-400 hover:text-blue-600 text-sm font-semibold transition-colors duration-200" data-reply-id="' .
                                    $reply->id .
                                    '">Pergjigju</button>';

                                // View Replies button (only if there are replies)
                                if ($hasReplies) {
                                    echo '<button class="toggle-replies text-blue-400 hover:text-blue-600 text-sm font-semibold transition-colors duration-200" data-reply-id="' .
                                        $reply->id .
                                        '">';
                                    echo 'Shiko ' . $reply->replies->count() . ' Pergjigjet';
                                    echo '</button>';
                                }

                                // Hidden reply form with transition
                                echo '<form action="' .
                                    route('posts.reply', $reply->post_id) .
                                    '" method="POST" class="mt-3 reply-form hidden w-full transition-all duration-300 ease-in-out" id="reply-form-' .
                                    $reply->id .
                                    '">';
                                echo csrf_field();
                                echo '<input type="hidden" name="parent_id" value="' . $reply->id . '">';
                                echo '<textarea name="body" class="outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-2 border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-800 dark:focus:border-blue-800 shadow-2xl" rows="3" placeholder="Pergjigju..." required></textarea>';
                                echo '<button type="submit" class="px-4 py-2 my-2 bg-gray-600 font-semibold shadow-2xl text-white rounded hover:bg-slate-800 transition-all duration-200">Pergjigju</button>';
                                echo '</form>';
                            }
                            echo '</div>';

                            // Nested replies container with transition
                            if ($hasReplies) {
                                echo '<div class="nested-replies hidden mt-4 transition-all duration-300 ease-in-out" id="replies-' .
                                    $reply->id .
                                    '">';
                                displayReplies($reply->replies, $level + 1);
                                echo '</div>';
                            }

                            echo '</div>';
                        }
                    }
                @endphp

                @php displayReplies($post->replies->whereNull('parent_id')) @endphp
            </div>
        </div>
    </div>

    <style>
        /* Base hidden state */
        .reply-form.hidden {
            opacity: 0;
            height: 0;
            margin-top: 0;
            overflow: hidden;
        }
    
        /* Visible state */
        .reply-form {
            opacity: 1;
            height: auto;
        }
    
        .nested-replies.hidden {
            opacity: 0;
            height: 0;
            margin-top: 0;
            overflow: hidden;
        }
    
        .nested-replies {
            opacity: 1;
            height: auto;
        }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle reply form toggling
        const replyButtons = document.querySelectorAll('.show-reply-form');
        replyButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const replyId = this.getAttribute('data-reply-id');
                const form = document.getElementById(`reply-form-${replyId}`);
                form.classList.toggle('hidden');
                this.textContent = form.classList.contains('hidden') ? 'Pergjigju' : 'Anulo';
            });
        });
    
        // Handle nested replies toggling
        const toggleButtons = document.querySelectorAll('.toggle-replies');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const replyId = this.getAttribute('data-reply-id');
                const repliesContainer = document.getElementById(`replies-${replyId}`);
                repliesContainer.classList.toggle('hidden');
                const replyCount = this.textContent.match(/\d+/)[0];
                this.textContent = repliesContainer.classList.contains('hidden') 
                    ? `Hape ${replyCount} Pergjigjet`
                    : `Mbylli ${replyCount} Pergjigjet`;
            });
        });
    });
    </script>
</x-layout>

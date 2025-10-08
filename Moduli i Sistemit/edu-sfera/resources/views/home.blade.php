<x-layout>
    <div class="flex ml-64 w-[75%] float-start my-6">
        <div class="w-full my-10">
            <!-- Search Form -->




            @if (!auth()->check())
                <div class="w-[80%] relative">
                    <div class="brightness-50 blur-sm mb-10 text-white shadow-9xl shadow-center">
                        <div class="mb-5">
                            <label for="username-success" class="block mb-2 text-sm font-medium ">Titulli</label>
                            <input type="text" id="username-success"
                                class="bg-green-50 border  block w-full p-2.5 dark:bg-gray-700 "
                                placeholder="Bonnie Green">

                        </div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pershkrimi</label>
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Leave a comment..."></textarea>
                        <div>
                            <label for="username-error" class="block mb-2 text-sm font-medium ">Tagjet</label>
                            <input type="text" id="username-error"
                                class="bg-red-50 border   text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700  block w-full p-2.5"
                                placeholder="Bonnie Green">

                        </div>
                    </div>

                    <a href="{{ route('posts.create') }}"
                        class="text-shadow bg-gradient-to-r from-black/10 via-black/50 to-black/10 w-full h-full text-center p-5 shadow-9xl text-white font-bold rounded-md absolute top-0 flex items-center justify-center text-4xl drop-shadow-lg">
                        Kyquni per te postuar
                    </a>
                </div>
            @else
                <div class="w-[80%] relative border-b-2 border-gray-500/50 pb-10 mb-5">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <h3 class="font-bold text-white text-3xl">Krijo Post</h3>

                        <div class="form-group mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titulli</label>
                            <input type="text" name="title" id="title" placeholder="Titulli"
                                class="block w-full p-4 ps-10 text-sm placeholder:font-bold shadow-md text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500  focus:border-blue-500 dark:bg-slate-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-150"
                                value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700">Pershkrimi</label>
                            <textarea name="body" id="body" rows="5" placeholder="Pershkrimi"
                                class="block w-full p-4 ps-10 text-sm placeholder:font-bold shadow-md text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500  focus:border-blue-500 dark:bg-slate-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-150"
                                required>{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tagjet (Te e ndara me presje)</label>
                            <input type="text" name="tags" id="tags"
                                class="block w-full p-4 ps-10 text-sm placeholder:font-bold shadow-md text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500  focus:border-blue-500 dark:bg-slate-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-150"value="{{ old('tags') }}"
                                placeholder="Tagu1, Tagu2, Tagu3">
                        </div>

                        <button type="submit"
                            class="px-4 py-2 bg-slate-500 text-white rounded hover:bg-slate-600 font-semibold transition-all duration-200">Krijo Post</button>
                    </form>
                </div>
            @endif

            <form action="{{ route('home') }}" method="GET" class="mb-6">
                {{-- <div class="flex items-center">
                    <input type="text" name="search" id="search"
                        class="w-[80%] px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search by title or tags (e.g., #tag1 #tag2)" value="{{ request('search') }}">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </div> --}}
                <label for="search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Kerko</label>
                <div class="relative w-[80%] group">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500  focus:border-blue-500 dark:bg-slate-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-150"
                        placeholder="Kerko prej titullit ose tagut (p.sh, #tagu1 #tagu2)" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 group-hover:bg-slate-900 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 dark:bg-slate-900 dark:group-hover:bg-blue-900 dark:focus:ring-slate-300 transition-all duration-200  shadow-inner">Kerko</button>
                </div>

            </form>

            @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}">
                    <div
                        class="post text-white  p-4 mb-7  border-b-2 border-gray-500/50 shadow-gray-800 max-w-6xl hover:bg-gray-500/50 hover:border-0 hover:shadow-xl hover:scale-102 rounded-md duration-transform-300 duration-colors-100 duration transition-all">
                        <div class="flex items-center justify-between mb-4 bg-slate-500/20 px-3 py-3">

                            <div class="flex items-center">
                                <img src="{{ asset($post->user->img) }}" alt="User Profile Picture"
                                    class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <span class="font-bold">{{ $post->user->name }}</span>
                                    <p class="text-sm text-gray-300">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <x-school-tag>{{ $post->user->uni }}</x-school-tag>


                        </div>

                        <!-- Post Title -->
                        <h2 class="text-2xl font-semibold mb-2">{{ $post->title }}</h2>

                        <!-- Post Body -->
                        <p class="text-lg mb-4">{{ Str::limit($post->body, 300) }}</p>

                        <!-- Tags -->
                        <div class="tags mb-4">
                            @foreach ($post->tags as $tag)
                                <span
                                    class="bg-slate-500 text-white text-sm px-3 py-1 rounded-full mr-2">#{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        <!-- Post Stats -->
                        <div class="post-stats flex  gap-4 text-sm text-gray-500">
                            <span title="views"
                                class="text-white bg-slate-700 px-3 py-1 rounded-2xl shadow-lg font-bold text-xl flex items-center group hover:scale-105 transition-all duration-150"><i
                                    class="fa-solid fa-eye mr-2 text-base group-hover:text-white text-gray-400"></i>{{ $post->views }}</span>
                            <span title="replies"
                                class="text-white bg-slate-700 px-3 py-1 rounded-2xl shadow-lg font-bold text-xl flex items-center group hover:scale-105 transition-all duration-150"><i
                                    class="fa-solid fa-note-sticky mr-2 text-base group-hover:text-white text-gray-400"></i>{{ $post->replies_count }}</span>
                            <span title="votes"
                                class="text-white bg-slate-700 px-3 py-1 rounded-2xl shadow-lg font-bold text-xl flex items-center group hover:scale-105 transition-all duration-150"><i
                                    class="fa-solid fa-check-to-slot mr-2 text-base group-hover:text-white text-gray-400"></i>
                                {{ $post->totalVotes() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach

            <!-- Pagination -->
            <div class="mt-4 w-[800px] float-start text-center">
                {{ $posts->links() }}
            </div>
        </div>
        <div class="text-white fixed right-10">
            <!-- Most Viewed Posts Section -->
            <div class="mb-8 w-[300px] bg-slate-600  rounded-lg shadow-center shadow-black/30 ">
                <h2
                    class="text-xl w-full text-center font-bold border-b-2 border-gray-300/50 py-5 bg-slate-800 rounded-t-lg">
                    Postet me te shikuara</h2>
                <div class="bg-slate-700 py-3 rounded-b-lg">
                    @foreach ($mostViewedPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="block before:absolute before:w-[10px] before:h-[10px] before:rounded-full before:bg-slate-500 before:left-4 before:translate-y-[25px]  before:z-50 ">
                            <div
                                class="bg-slate-700 p-5 py-5 flex justify-between border-l-2 border-slate-500 mx-5 relative group transition-all duration-300">
                                <h3 class="text-lg font-bold group-hover:text-xl transition-all duration-300">
                                    {{ substr($post->title, 0, 9) }}...</h3>
                                <p class="text-xs text-gray-300  group-hover:text-white  transition-all duration-300">
                                    {{ $post->views }} views</p>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>

            <!-- Most Voted Posts Section -->
            <div class="mb-8 w-[300px] bg-slate-600  rounded-lg shadow-center shadow-black/30 ">
                <h2
                    class="text-xl w-full text-center font-bold border-b-2 border-gray-300/50 py-5 bg-slate-800 rounded-t-lg">
                    Postet me te votuara</h2>
                <div class="bg-slate-700 py-3 rounded-b-lg">
                    @foreach ($mostVotedPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="block before:absolute before:w-[10px] before:h-[10px] before:rounded-full group transition-all duration-300 before:bg-slate-500 before:left-4 before:translate-y-[25px]  before:z-50 ">
                            <div
                                class="bg-slate-700 p-5 py-5 flex justify-between border-l-2 border-slate-500 mx-5 relative ">
                                <h3 class="text-lg font-bold group-hover:text-xl transition-all duration-300">
                                    {{ substr($post->title, 0, 9) }}...</h3>
                                <p class="text-xs text-gray-300 group-hover:text-white  transition-all duration-300">
                                    {{ $post->total_votes }} votes</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-layout>

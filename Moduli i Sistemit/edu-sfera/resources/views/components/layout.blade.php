<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edu-Sfera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <script>
        window.userId = "{{ auth()->id() }}"; // Add this line

        document.addEventListener("alpine:init", () => {
            Alpine.store("chat", {
                isOpen: false,
                friendId: null,
                friendName: '',
                messages: [],
                newMessage: '',

                // Initialize Pusher for real-time updates
                init() {
                    Pusher.logToConsole = true;

                    const pusher = new Pusher("4fbb48faa1acb31f9c78", {
                        cluster: "eu",
                        encrypted: true,
                        authEndpoint: '/pusher/auth'
                    });

                    // Subscribe to private chat channel for real-time messages
                    const channel = pusher.subscribe("private-chat.{{ auth()->id() }}");
                    channel.bind("MessageSent", (data) => {
                        console.log("New message received:", data.message);
                        this.messages.push(data.message);
                    });
                },

                // Open the chat box and fetch messages
                openChat(friendId, friendName) {
                    console.log('Opening chat for:', friendId, friendName); // Debugging
                    this.isOpen = true;
                    this.friendId = friendId;
                    this.friendName = friendName;
                    this.fetchMessages();
                },

                // Fetch messages for the selected friend
                fetchMessages() {
                    fetch(`/messages/create/${this.friendId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Messages received:', data); // Debugging
                            this.messages = data.messages;
                        })
                        .catch(error => {
                            console.error('Error fetching messages:', error);
                        });
                },

                // Send a new message
                sendMessage() {
                    if (this.newMessage.trim()) {
                        // First, fetch or create the conversation
                        fetch(`/messages/create/${this.friendId}`)
                            .then(response => response.json())
                            .then(data => {
                                const conversationId = data.conversation.id;

                                // Now send the message
                                fetch(`/messages/store/${conversationId}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            message: this.newMessage
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        this.messages.push(data
                                            .message); // Add the new message to the list
                                        this.newMessage = ''; // Clear the input
                                    })
                                    .catch(error => {
                                        console.error('Error sending message:', error);
                                    });
                            })
                            .catch(error => {
                                console.error('Error fetching conversation:', error);
                            });
                    }
                },

                // Close the chat box
                closeChat() {
                    this.isOpen = false;
                    this.friendId = null;
                    this.friendName = '';
                    this.messages = [];
                }
            });
        });
    </script>



</head>

<body class="*:box-border *:p-0 *:m-0 *:font-HG min-h-screen dark:bg-gray-700 overflow-x-hidden">

    <aside class="flex justify-center z-40 fixed min-h-screen  bg-gray-300 dark:bg-gray-800">
        <div class=" flex flex-col items-center">
            <div class="block mt-8">
                <img width="80px" src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <div class="flex flex-col h-[80%] justify-between">
                <nav class="flex flex-col items-center gap-4 justify-center mt-16">
                    <x-sidebar-link href='/'>
                        <i class="fa-solid fa-house"></i>


                    </x-sidebar-link>


                    @auth
                        <x-sidebar-link href="/quizzes">
                            <i class="fa-solid fa-question"></i>

                        </x-sidebar-link>

                        <x-sidebar-link>
                            <button id="chatsBtn">
                                <i class="fas fa-comments"></i>


                            </button>
                        </x-sidebar-link>


                    @endauth

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let chats = document.querySelector('#chatsContainer');
                            let chatsBtn = document.querySelector('#chatsBtn');

                            if (chats && chatsBtn) {
                                chatsBtn.addEventListener('click', function() {
                                    if (chats.classList.contains('hidden')) {

                                        chats.classList.remove('hidden');
                                        setTimeout(() => {
                                            chats.classList.remove('-translate-x-full', 'opacity-0');
                                            chats.classList.add('translate-x-0', 'opacity-100', 'z-50');
                                        }, 10);

                                    } else {

                                        chats.classList.remove('translate-x-0', 'opacity-100', 'z-50');
                                        chats.classList.add('-translate-x-full', 'opacity-0');

                                        setTimeout(() => {
                                            chats.classList.add('hidden');
                                        }, 300);
                                    }
                                });
                            } else {
                                console.log("Chats container or button not found");
                            }
                        });
                    </script>

                </nav>

                @guest
                    <x-sidebar-link href="/login">
                        <i class="fas fa-gear"></i>
                    </x-sidebar-link>
                @endguest
                @auth
                    <x-dropdown></x-dropdown>
                @endauth
                {{-- @if (!Auth::check())
                    <x-sidebar-link :href="route('login')">
                        <i class="fas fa-gear"></i>
                    </x-sidebar-link>
                    @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
      
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
      
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
      
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
      
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                              this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown> 
                @endif  --}}

            </div>
        </div>
        @auth

            @php
                // Fetch accepted friend requests where the current user is either the sender or receiver
                $acceptedFriends = \App\Models\FriendRequest::where(function ($query) {
                    $query->where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id());
                })
                    ->where('status', 'accepted')
                    ->get();
            @endphp
            <div id="chatsContainer"
                class="w-[250px] flex flex-col justify-between p-5 font-bold text-gray-300 bg-gray-800 border-l-2 border-r-2 -translate-x-full opacity-0 hidden border-gray-900 transition-all duration-300">
                <!-- Friends Heading and Friends List -->
                <div>
                    <h3>Shoket</h3>
                    <div class="flex gap-6 flex-col mt-10">
                        @if ($acceptedFriends->isEmpty())
                            <x-empty>Ju ende nuk keni shok</x-empty>
                        @else
                            @foreach ($acceptedFriends as $friendRequest)
                                @php
                                    $friend =
                                        $friendRequest->sender_id == auth()->id()
                                            ? $friendRequest->receiver
                                            : $friendRequest->sender;
                                @endphp

                                <div x-data="{ open: false }" class="relative">
                                    <a href="#"
                                        class="flex px-3 py-2 hover:bg-gray-600 rounded-lg items-center justify-between"
                                        @click.prevent="open = !open">
                                        <img width="50px" class="h-[50px] rounded-full"
                                            src="{{ asset('images/male.png') }}" alt="">
                                        <h4>{{ $friend->name }} {{ $friend->surname }}</h4>
                                    </a>

                                    <div x-show="open" x-transition
                                        class="absolute right-0 mt-2 bg-gray-800 text-white p-2 rounded-md shadow-lg">
                                        <form action="{{ route('friends.remove', $friend->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="alert('Sapo keni fshi shoqerine tuaj me {{ $friend->name }}')" class="px-4 py-2 hover:bg-gray-600 w-full">Fshi Shokun</button>
                                        </form>
                                        <button @click="$store.chat.openChat('{{ $friend->id }}', '{{ $friend->name }}')" class="px-4 py-2 hover:bg-gray-600 w-full">Dergo Mesazh</button>
                                        <a href="{{ route('profile.show', $friend->id) }}" class="px-4 py-2 hover:bg-gray-600 w-full">Shiko Profilin</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Manage Friends Section -->
                <div>
                    @php
                        $pendingRequests = \App\Models\FriendRequest::where('receiver_id', auth()->id())
                            ->where('status', 'pending')
                            ->count();
                    @endphp
                    <a href="{{ route('friends.list') }}" class="{{ $pendingRequests > 0 ? 'highlight' : '' }} width">
                        <h4 class="p-4 bg-slate-500 rounded-xl relative text-center">Menaxho shoket
                            @if ($pendingRequests > 0)
                                <span class="absolute -right-3 -bottom-3 py-1 px-3 bg-red-500 rounded-full">
                                    {{ $pendingRequests }}
                                </span>
                            @endif
                        </h4>
                    </a>
                </div>
            </div>

        @endauth



    </aside>

    <div class="relative w-screen z-0 float-right">
        {{ $slot }}
    </div>

    <!-- Chat Widget -->
    <div x-data="{}" x-show="$store.chat.isOpen" x-transition
        class="fixed bottom-32 right-4 w-80 bg-white text-black rounded-lg shadow-lg z-50">
        <!-- Chat Header -->
        <div class="flex justify-between items-center p-4 bg-gray-700 rounded-t-lg">
            <h3 x-text="$store.chat.friendName" class="font-bold text-white"></h3>
            <button @click="$store.chat.closeChat()" class="text-white hover:text-gray-400">&times;</button>
        </div>

        <!-- Chat Messages -->
        <div class="h-48 overflow-y-auto p-2 space-y-2 bg-gray-800">
            <template x-for="message in $store.chat.messages" :key="message.id">
                <div class="flex" :class="message.sender.id == window.userId ? 'justify-end' : 'justify-start'">
                    <p class="text-sm p-2 rounded-md max-w-xs"
                        :class="message.sender.id == window.userId ? 'bg-blue-900 text-white self-end' :
                            'bg-green-900 text-gray-100 self-start'"
                        x-text="message.message">
                    </p>
                </div>
            </template>
        </div>

        <!-- Message Input -->
        <form @submit.prevent="$store.chat.sendMessage()" class="border-t border-gray-700 flex ">
            <input type="text" x-model="$store.chat.newMessage"
                class="p-2 bg-slate-900 rounded-bl-md text-white outline-none ring-0 font-semibold w-[70%]"
                placeholder="Shkruaj nje mesazh">
            <button type="submit" class=" bg-blue-900 text-white  w-[29%] h-full py-3 px-4">Dergo</button>
        </form>
    </div>
</body>

</html>
`

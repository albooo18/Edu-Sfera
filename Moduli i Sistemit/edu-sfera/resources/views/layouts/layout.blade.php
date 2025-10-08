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
</head>

<body class="*:box-border *:p-0 *:m-0 *:font-HG min-h-screen dark:bg-gray-700">

    <aside class="flex justify-center fixed min-h-screen px-6 bg-gray-300 dark:bg-gray-800">
        <div class=" flex flex-col items-center">
            <div class="block mt-8">
                <img width="70px" src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <div class="flex flex-col h-[80%] justify-between">
                <nav class="flex flex-col items-center gap-4 justify-center mt-16">
                    <x-sidebar-link href='/'>
                        <i class="fa-solid fa-house"></i>
                    </x-sidebar-link>

                    <x-sidebar-link href="/quizzes">
                        <i class="fa-solid fa-question"></i>
                    </x-sidebar-link>
                    <x-sidebar-link>
                        <i class="fas fa-comments"></i>
                    </x-sidebar-link>

                </nav>
                @if (!Auth::check())
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

                            <!-- Authentication -->
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
                @endif

            </div>
        </div>
        @auth

            <div class="w-[250px] p-5 font-bold text-gray-300 bg-gray-800 border-l-2 border-r-2 border-gray-900">
                <h3>Friends</h3>
                <div class="flex gap-6 flex-col mt-10">
                    <a href="#" class="flex px-3 py-2 hover:bg-gray-600 rounded-lg items-center justify-between">
                        <img width="50px" class="h-[50px] rounded-full" src="{{ asset('images/male.png') }}"
                            alt="">
                        <h4>
                            John Doe
                        </h4>
                    </a>
                    <a href="#" class="flex px-3 py-2 hover:bg-gray-600 rounded-lg items-center justify-between">
                        <img width="50px" class="h-[50px] rounded-full" src="{{ asset('images/test.png') }}"
                            alt="">
                        <h4>
                            Elisa More
                        </h4>
                    </a>
                    <a href="#"
                        class="flex px-3 py-2 hover:bg-gray-600 rounded-lg items-center justify-between overflow-hidden">
                        <img width="50px" class="h-[50px] rounded-full" src="{{ asset('images/male.png') }}"
                            alt="">
                        <h4>
                            Albi Mehmeti
                        </h4>
                    </a>
                </div>
            </div>
        @endauth


    </aside>

    <div>
        @yield('content')
    </div>
</body>

</html>
`

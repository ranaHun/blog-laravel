<!doctype html>

<head>
    <title>Blog</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script type="text/javascript" src="{{ asset('js/GifBlockPlugin/dist/bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .clamp {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .clamp.one-line {
            -webkit-line-clamp: 1;
        }
    </style>
</head>

<body style="font-family: Open Sans, sans-serif">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-900">
        <section class="max-w-6xl p sm:px-6 lg:px-8 py-8 w-full">


            <nav class="px-2 bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
                <div class="container flex flex-wrap items-center justify-between mx-auto">
                    <a href="#" class="flex items-center">
                        <img src="https://via.placeholder.com/100" class="h-6 mr-3 sm:h-10" alt="Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">CMS</span>
                    </a>
                    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                        <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                            @auth
                            <li>
                                <a href="/admin/articles" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-white dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Dashboard</a>
                            </li>
                            <li>
                                <a href="/admin/articles/create" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">New Article</a>
                            </li>

                            @endauth
                            @auth
                            <li>
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                            Welcome, {{ auth()->user()->name }}!
                                        </button>
                                    </x-slot>
                                    <x-dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">
                                        Log Out
                                    </x-dropdown-item>

                                    <form id="logout-form" method="POST" action="/logout" class="hidden">
                                        @csrf
                                    </form>
                                </x-dropdown>
                            </li>
                            @else

                            <li>
                                <a href="/register" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->is('register') ? 'text-blue-500' : '' }}">
                                    Register
                                </a>
                            </li>
                            <li>
                                <a href="/login" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->is('login') ? 'text-blue-500' : '' }}">
                                    Log In
                                </a>
                            </li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </nav>

            {{ $slot }}

        </section>
    </div>


    <x-flash />
</body>
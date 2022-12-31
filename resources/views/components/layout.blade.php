<!doctype html>

<head>
    <title>Blog</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <nav class="md:flex md:justify-between md:items-center bg-gray-800">
                <div>
                    <a href="/">
                        <img src="/images/logo.svg" alt="Logo" width="165" height="16">
                    </a>
                </div>

                <div class="mt-8 md:mt-0 flex items-center">
                    @auth
                         
                    @else
                        <a href="/register"
                        class="text-xs font-bold uppercase {{ request()->is('register') ? 'text-blue-500' : '' }}">
                            Register
                        </a>

                        <a href="/login"
                        class="ml-6 text-xs font-bold uppercase {{ request()->is('login') ? 'text-blue-500' : '' }}">
                            Log In
                        </a>
                    @endauth

                </div>
            </nav>

            {{ $slot }}

            <!-- <footer
                    class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            </footer> -->
        </section>
    </div>
   

    <x-flash/>
</body>
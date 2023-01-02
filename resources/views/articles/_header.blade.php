<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl text-gray-400 ">
        Latest <span class="text-gray-200">Tech</span> News
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                <input type="text" name="search" placeholder="Search Article" class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('search') }}">
            </form>
        </div>
    </div>
</header>
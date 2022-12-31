<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-800 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-400"></h1>

            <form method="POST" action="/register" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-slate-200"
                           for="name"
                    >
                        Name
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="name"
                           id="name"
                           required
                    >
                </div>


                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-slate-200"
                           for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="email"
                           name="email"
                           id="email"
                           required
                    >
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-slate-200"
                           for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                </div>

                <div class="mb-6 ">
                    <button type="submit"
                            class="bg-gray-400 text-gray-800 rounded py-2 px-4 hover:bg-gray-500"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
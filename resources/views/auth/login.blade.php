<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-800 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-400">Log In</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf
                <x-form.input name="email" type="email" autocomplete="username" required />
                <x-form.input name="password" type="password" autocomplete="current-password" required />
                <x-form.button>Log In</x-form.button>
            </form>

        </main>
    </section>
</x-layout>
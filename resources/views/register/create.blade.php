<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-800 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-400">Register!</h1>

            <form method="POST" action="/register" class="mt-10">
                @csrf
                <x-form.input name="name" required />
                <x-form.input name="email" type="email" required />
                <x-form.input name="password" type="password" autocomplete="new-password" required />
                <x-form.input name="password_confirmation" type="password" autocomplete="new-password" required />
                <x-form.button>Sign Up</x-form.button>
            </form>
        </main>
    </section>
</x-layout>
@props(['article'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5 h-full flex flex-col bg-gray-700">
        <div class="mt-6 flex flex-col justify-between flex-1">
            <header>

                <div class="mt-4">
                    <h1 class="text-3xl clamp one-line">
                        <a href="/articles/{{ $article->slug }}">
                            {{ $article->title }}
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>{{ $article->created_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                   
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="/?author={{ $article->author->username }}">{{ $article->author->name }}</a>
                        </h5>
                    </div>
                </div>

                <div>
                    <a href="/articles/{{ $article->slug }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
@props(['articles'])

@if ($articles->count() > 1)
    <div class="lg:grid lg:grid-cols-6 bg-red" >
        @foreach ($articles->skip(1) as $article)
            <x-article-card
                :article="$article"
                class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"
            />
        @endforeach
    </div>
@endif
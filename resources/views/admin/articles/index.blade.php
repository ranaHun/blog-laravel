<x-layout>
    <section class="py-8 max-w-4xl mx-auto">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200 divide-y divide-gray-500">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published Date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($articles as $article)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900 clamp one-line">
                                                <a href="/articles/{{ $article->slug }}">
                                                    {{ $article->title }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="">
                                                    {{ $article->author->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y H:i')}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/articles/{{ $article->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        <i class="fa fa-comments" aria-hidden="true"></i>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/articles/{{ $article->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-xs text-red-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center bg-gray-200">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
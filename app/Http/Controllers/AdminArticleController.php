<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\Article;

class AdminArticleController extends Controller
{
    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::with('author')->latest('published_at')->paginate(10)
        ]);
    }
    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store()
    {
        Article::create(array_merge($this->validateArticle(), [
            'user_id' => request()->user()->id
        ]));

        return redirect('/');
    }
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('success', 'Article Deleted!');
    }
    protected function validateArticle(?Article $article = null): array
    {
        $article ??= new Article();

        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('articles', 'slug')->ignore($article)],
            'body' => 'required',
        ]);
    }
}

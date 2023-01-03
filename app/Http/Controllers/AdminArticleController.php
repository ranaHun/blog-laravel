<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\Article;
use Mockery\Expectation;
use \Carbon\Carbon;

class AdminArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        try {
            $dataToSave = array_merge($this->validateArticle(), [
                'user_id' => auth()->user()->id,
                'published_at' => Carbon::now()
            ]);
            Article::create($dataToSave);

            return redirect('/admin/articles')->with('success', 'Article was created');
        } catch (Expectation $e) {

        }
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

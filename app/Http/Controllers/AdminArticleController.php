<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Article;
use App\Models\User;

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
        // return view('admin.articles.create', ['users' => User::authors()->pluck('name', 'id'),]);
    }

    public function store()
    {
        Article::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id
        ]));

        return redirect('/');
    }
}

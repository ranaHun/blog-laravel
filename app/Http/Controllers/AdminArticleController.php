<?php
namespace App\Http\Controllers;
use App\Models\Article;

class AdminArticleController extends Controller {
    public function index()
    {
        return view('admin.articles.index', [
            'posts' => Article::paginate(50)
        ]);
    }
    public function create()
    {
        return view('admin.articles.create');
    }

    public function store()
    {
        Article::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id
        ]));

        return redirect('/');
    }
}

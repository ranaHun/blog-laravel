<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::latest('published_at')->filter(
                        request(['search', 'author'])
                    )->paginate(17)->withQueryString()
        ]);
    }

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }
}
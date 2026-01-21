<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function show(string $slug): View
    {
        $article = Article::query()
            ->with(['category', 'reporter', 'tags', 'media'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('articles.show', [
            'article' => $article,
        ]);
    }
}

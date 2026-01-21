<?php

namespace App\Http\Controllers\Public;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function show(Request $request, string $slug): View
    {
        $article = Article::query()
            ->with(['category', 'reporter', 'tags', 'media'])
            ->where('slug', $slug)
            ->where('status', ArticleStatus::PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        return view('articles.show', [
            'article' => $article,
        ]);
    }
}

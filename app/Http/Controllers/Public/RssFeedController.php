<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Response;

class RssFeedController extends Controller
{
    public function __invoke(): Response
    {
        $articles = Article::query()
            ->published()
            ->latest('published_at')
            ->take(20)
            ->get();

        return response()
            ->view('feed.rss', [
                'articles' => $articles,
            ])
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}

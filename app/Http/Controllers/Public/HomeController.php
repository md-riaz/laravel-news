<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $articles = Article::query()
            ->with(['category', 'reporter', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        return view('home', [
            'articles' => $articles,
        ]);
    }
}

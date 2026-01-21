<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $entries = collect([
            [
                'loc' => route('home'),
                'lastmod' => now()->toAtomString(),
            ],
        ])
            ->merge($this->articleEntries())
            ->merge($this->pageEntries());

        return response()
            ->view('feed.sitemap', [
                'entries' => $entries,
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function articleEntries(): Collection
    {
        return Article::query()
            ->published()
            ->latest('published_at')
            ->get()
            ->map(fn (Article $article) => [
                'loc' => route('articles.show', $article->slug),
                'lastmod' => optional($article->published_at)->toAtomString(),
            ]);
    }

    private function pageEntries(): Collection
    {
        return Page::query()
            ->published()
            ->latest('published_at')
            ->get()
            ->map(fn (Page $page) => [
                'loc' => route('pages.show', $page->slug),
                'lastmod' => optional($page->published_at)->toAtomString(),
            ]);
    }
}

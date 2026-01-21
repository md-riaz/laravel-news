<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Reporter;
use Illuminate\View\View;

class ReporterController extends Controller
{
    public function show(string $slug): View
    {
        $reporter = Reporter::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $articles = $reporter->articles()
            ->with(['category'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $articles->getCollection()->each(function ($article) use ($reporter): void {
            $article->setRelation('reporter', $reporter);
        });

        return view('reporters.show', [
            'reporter' => $reporter,
            'articles' => $articles,
        ]);
    }
}

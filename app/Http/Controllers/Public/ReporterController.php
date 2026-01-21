<?php

namespace App\Http\Controllers\Public;

use App\Enums\ArticleStatus;
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
            ->with(['category', 'reporter', 'tags'])
            ->where('status', ArticleStatus::PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(12);

        return view('reporters.show', [
            'reporter' => $reporter,
            'articles' => $articles,
        ]);
    }
}

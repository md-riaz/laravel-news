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
            ->with(['category', 'reporter', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        return view('reporters.show', [
            'reporter' => $reporter,
            'articles' => $articles,
        ]);
    }
}

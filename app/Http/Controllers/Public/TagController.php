<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    public function show(string $slug): View
    {
        $tag = Tag::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $articles = $tag->articles()
            ->with(['category', 'reporter'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        return view('tags.show', [
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}

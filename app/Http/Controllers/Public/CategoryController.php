<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $slug): View
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $articles = $category->articles()
            ->with(['category', 'reporter', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        return view('categories.show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}

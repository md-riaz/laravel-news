@props([
    'article',
    'showCategory' => true,
])

<article {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white p-6 shadow-sm']) }}>
    <div class="flex items-center gap-2 text-xs text-slate-500">
        @if ($showCategory)
            <span>{{ $article->category?->name ?? 'Uncategorized' }}</span>
            <span aria-hidden="true">•</span>
        @endif
        <time datetime="{{ optional($article->published_at)->toDateString() }}">
            {{ optional($article->published_at)->format('M d, Y') }}
        </time>
    </div>
    <h2 class="mt-3 text-xl font-semibold text-slate-900">
        <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-slate-700">
            {{ $article->headline }}
        </a>
    </h2>
    @if ($article->excerpt)
        <p class="mt-2 text-sm text-slate-600">{{ $article->excerpt }}</p>
    @endif
    <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
        <span>By {{ $article->reporter?->name ?? 'Staff' }}</span>
        <a href="{{ route('articles.show', $article->slug) }}" class="font-medium text-slate-700">
            Read story →
        </a>
    </div>
</article>

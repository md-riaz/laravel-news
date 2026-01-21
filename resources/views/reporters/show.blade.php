@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <a href="{{ route('home') }}" class="text-sm text-slate-500">← Back to latest</a>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $reporter->name }}</h1>
            @if ($reporter->bio)
                <p class="mt-2 text-slate-600">{{ $reporter->bio }}</p>
            @endif
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($articles as $article)
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-xs text-slate-500">
                        <span>{{ $article->category?->name ?? 'Uncategorized' }}</span>
                        <span aria-hidden="true">•</span>
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
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
                    No published articles from this reporter yet.
                </div>
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection

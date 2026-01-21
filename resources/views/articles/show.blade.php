@extends('layouts.app')

@section('title', $article->headline)
@section('meta_description', $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->body ?? ''), 160))

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <a href="{{ route('home') }}" class="text-sm text-slate-500">← Back to latest</a>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $article->headline }}</h1>
            <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <span>{{ $article->category?->name ?? 'Uncategorized' }}</span>
                <span aria-hidden="true">•</span>
                <span>By {{ $article->reporter?->name ?? 'Staff' }}</span>
                <span aria-hidden="true">•</span>
                <time datetime="{{ optional($article->published_at)->toDateString() }}">
                    {{ optional($article->published_at)->format('M d, Y') }}
                </time>
            </div>
        </div>

        @if ($article->excerpt)
            <p class="text-lg text-slate-700">{{ $article->excerpt }}</p>
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($article->body)) !!}
        </div>

        @if ($article->tags->isNotEmpty())
            <div class="flex flex-wrap gap-2">
                @foreach ($article->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

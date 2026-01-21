@extends('layouts.app')

@section('title', "Tag: {$tag->name}")
@section('meta_description', "Stories tagged with {$tag->name}.")

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <a href="{{ route('home') }}" class="text-sm text-slate-500">← Back to latest</a>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">Tag: {{ $tag->name }}</h1>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <x-empty-state message="No published articles with this tag yet." />
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection

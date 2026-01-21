@extends('layouts.app')

@section('title', $reporter->name)
@section('meta_description', "Articles written by {$reporter->name}.")
@section('canonical', route('reporters.show', $reporter->slug))

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
                <x-article-card :article="$article" />
            @empty
                <x-empty-state message="No published articles from this reporter yet." />
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection

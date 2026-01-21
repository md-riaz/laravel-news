@extends('layouts.app')

@section('title', 'Latest Articles')
@section('meta_description', 'Catch up on the most recent stories from the Laravel community.')

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">Latest Articles</h1>
            <p class="mt-2 text-slate-600">Catch up on the most recent stories from the Laravel community.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <x-empty-state message="No published articles yet." />
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection

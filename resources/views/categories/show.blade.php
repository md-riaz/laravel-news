@extends('layouts.app')

@section('title', $category->name)
@section('meta_description', "Browse the latest articles in {$category->name}.")
@section('canonical', route('categories.show', $category->slug))

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <a href="{{ route('home') }}" class="text-sm text-slate-500">← Back to latest</a>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $category->name }}</h1>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($articles as $article)
                <x-article-card :article="$article" :show-category="false" />
            @empty
                <x-empty-state message="No published articles in this category yet." />
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection

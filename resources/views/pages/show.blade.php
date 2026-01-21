@extends('layouts.app')

@section('title', $page->title)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($page->body ?? ''), 160))
@section('canonical', route('pages.show', $page->slug))

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <a href="{{ route('home') }}" class="text-sm text-slate-500">← Back to latest</a>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $page->title }}</h1>
            <time class="mt-2 block text-sm text-slate-500" datetime="{{ optional($page->published_at)->toDateString() }}">
                {{ optional($page->published_at)->format('M d, Y') }}
            </time>
        </div>

        <div class="prose max-w-none">
            {!! nl2br(e($page->body)) !!}
        </div>
    </div>
@endsection

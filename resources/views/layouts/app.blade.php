<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Laravel News' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-slate-50 text-slate-900">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
                <a href="{{ route('home') }}" class="text-lg font-semibold text-slate-900">Laravel News</a>
                <nav class="flex items-center gap-4 text-sm text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-slate-900">Home</a>
                    <a href="{{ route('pages.show', 'about') }}" class="hover:text-slate-900">About</a>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-5xl flex-col gap-2 px-6 py-6 text-sm text-slate-500">
                <span>Laravel News Portal</span>
                <span>Latest coverage of the Laravel ecosystem.</span>
            </div>
        </footer>
    </body>
</html>

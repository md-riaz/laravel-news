<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Laravel News</title>
        <link>{{ route('home') }}</link>
        <description>Latest coverage of the Laravel ecosystem.</description>
        <language>{{ str_replace('_', '-', app()->getLocale()) }}</language>
        @foreach ($articles as $article)
            <item>
                <title>{{ $article->headline }}</title>
                <link>{{ route('articles.show', $article->slug) }}</link>
                <guid isPermaLink="true">{{ route('articles.show', $article->slug) }}</guid>
                @if ($article->excerpt)
                    <description><![CDATA[{!! $article->excerpt !!}]]></description>
                @endif
                @if ($article->published_at)
                    <pubDate>{{ $article->published_at->toRssString() }}</pubDate>
                @endif
            </item>
        @endforeach
    </channel>
</rss>

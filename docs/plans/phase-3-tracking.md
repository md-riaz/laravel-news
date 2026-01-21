# Phase 3 Tracking — Frontend Templates & Routing

## Goals

- Implement Blade templates for public routes.
- Add reusable components for cards and widgets.
- Implement response caching, sitemaps, RSS, and schema output.

## Current Implementation Check

- Public routing currently includes a health check endpoint and a default welcome page.
- No dedicated public controllers, templates, or SEO components are present yet.

## Plan

### Routing + Controllers

- [ ] Add route groupings for homepage, category, tag, author, article, and static pages.
- [ ] Create controllers to fetch published content and enforce visibility rules.
- [ ] Add pagination and canonical route handling.

### Blade Templates + Components

- [ ] Create a base layout with SEO-ready head slots.
- [ ] Build article, category, tag, and author templates.
- [ ] Add reusable Blade components for cards, lists, breadcrumbs, and media blocks.

### SEO + Structured Data

- [ ] Implement meta tags, OpenGraph, and Twitter card helpers.
- [ ] Add JSON-LD schema output for articles and collections.
- [ ] Wire canonical URL helpers and hreflang (if needed).

### Caching + Feeds

- [ ] Add response caching middleware and cache invalidation hooks on publish/update.
- [ ] Build XML sitemap generation and routes.
- [ ] Add RSS feeds for latest articles and category/tag streams.

## Status

- **Overall:** ⏳ Planned.

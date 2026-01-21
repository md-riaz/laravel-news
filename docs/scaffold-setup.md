# Scaffold Setup Guide

This guide describes the initial project setup for the Laravel News Portal. It focuses on a clean, repeatable install path with the locked stack from the specification.

## 1. Prerequisites

- PHP 8.3+
- Composer 2.x
- Node.js 20+ (for asset builds)
- MySQL 8 or MariaDB
- Redis
- Imagick (with WebP/AVIF support)
- Typesense server (for search)

## 2. Create the Laravel Application

```bash
composer create-project laravel/laravel laravel-news
cd laravel-news
```

## 3. Install Core Packages

```bash
composer require filament/filament
composer require spatie/laravel-medialibrary
composer require spatie/laravel-responsecache
composer require spatie/laravel-sitemap
composer require spatie/schema-org
composer require spatie/laravel-feed
composer require laravel/scout
composer require artesaos/seotools
```

Optional (recommended) for analytics:

```bash
composer require spatie/laravel-analytics
```

## 4. Configure Environment Variables

Create a `.env` from `.env.example` and set the following values:

```env
APP_NAME="Laravel News"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_news
DB_USERNAME=laravel
DB_PASSWORD=secret

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

SCOUT_DRIVER=typesense
TYPESENSE_HOST=127.0.0.1
TYPESENSE_PORT=8108
TYPESENSE_PROTOCOL=http
TYPESENSE_API_KEY=local-typesense-key
```

## 5. Publish Vendor Configs

```bash
php artisan vendor:publish --provider="Filament\FilamentServiceProvider"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"
php artisan vendor:publish --provider="Spatie\ResponseCache\ResponseCacheServiceProvider"
php artisan vendor:publish --provider="Spatie\Sitemap\SitemapServiceProvider"
php artisan vendor:publish --provider="Spatie\LaravelFeed\FeedServiceProvider"
php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
```

## 6. Run Migrations and Seeders

```bash
php artisan migrate
php artisan db:seed
```

## 7. Start Local Services

```bash
php artisan serve
```

Run queue workers:

```bash
php artisan queue:work
```

## 8. Verify Install

- Confirm the Filament admin panel loads.
- Confirm database migrations ran without errors.
- Confirm Redis, Typesense, and queue services connect.

## 9. Next Steps

- Build core models and relationships.
- Implement Filament resources and workflow rules.
- Add Blade templates and public routes.
- Wire search indexing and media conversions.

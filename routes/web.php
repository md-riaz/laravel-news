<?php

use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ReporterController;
use App\Http\Controllers\Public\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/health', \App\Http\Controllers\HealthCheckController::class);

Route::get('/', HomeController::class)->name('home');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');
Route::get('/reporters/{slug}', [ReporterController::class, 'show'])->name('reporters.show');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

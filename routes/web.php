<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', \App\Http\Controllers\HealthCheckController::class);

Route::get('/', function () {
    return view('welcome');
});

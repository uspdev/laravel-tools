<?php

use Uspdev\LaravelTools\Http\Controllers\MainController;
use Uspdev\LaravelTools\Http\Controllers\LogViewerController;

Route::get(config('laravel-tools.dashboardRoutes'), [MainController::class, 'dashboard'])->name('laravel-tools.dashboard');
Route::get('logs', [LogViewerController::class, 'index'])->name('laravel-tools.logs');

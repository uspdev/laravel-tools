<?php

use Uspdev\LaravelTools\Http\Controllers\MainController;
use Uspdev\LaravelTools\Http\Controllers\LogViewerController;

Route::get('app', [MainController::class, 'app'])->name('laravel-tools.app');
Route::get('bibliotecas', [MainController::class, 'bibliotecas'])->name('laravel-tools.bibliotecas');
Route::get('logs', [LogViewerController::class, 'index'])->name('laravel-tools.logs');

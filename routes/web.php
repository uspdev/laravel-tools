<?php

use Uspdev\LaravelTools\Http\Controllers\MainController;
use Uspdev\LaravelTools\Http\Controllers\LogViewerController;

Route::get('app', [MainController::class, 'app'])->name('laravel-tools.app');
Route::get('bibliotecas', [MainController::class, 'bibliotecas'])->name('laravel-tools.bibliotecas');
Route::get('logs', [LogViewerController::class, 'index'])->name('laravel-tools.logs');

Route::get('backup', [MainController::class, 'backup'])->name('laravel-tools.backup');
Route::post('backup/create', [MainController::class, 'createBackup'])->name('laravel-tools.createBackup');
Route::post('backup/load', [MainController::class, 'loadBackup'])->name('laravel-tools.loadBackup');
Route::post('backup/delete', [MainController::class, 'deleteBackup'])->name('laravel-tools.deleteBackup');
Route::get('backup/download', [MainController::class, 'downloadBackup'])->name('laravel-tools.downloadBackup');
Route::post('backup/upload', [MainController::class, 'uploadBackup'])->name('laravel-tools.uploadBackup');

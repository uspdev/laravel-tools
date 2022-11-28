<?php

use Uspdev\LaravelTools\Http\Controllers\MainController;

Route::get(config('laravel-tools.dashboardRoutes'), [MainController::class, 'dashboard'])->name('laravel-tools.dashboard');

<?php

namespace Uspdev\LaravelTools\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Uspdev\UspTheme\Events\UspThemeParseKey;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (config('laravel-tools.prefix')) {
            Event::listen(function (UspThemeParseKey $event) {
                if (isset($event->item['key']) && $event->item['key'] == 'laravel-tools') {
                    $event->item = [
                        'text' => '<i class="fas fa-toolbox text-danger"></i>',
                        'url' => route('laravel-tools.app'),
                        'title' => 'Laravel tools Dashboard',
                        'can' => ($event->item['can'] ?? 'admin'),
                    ];
                }
                return $event->item;
            });
        }
    }
}

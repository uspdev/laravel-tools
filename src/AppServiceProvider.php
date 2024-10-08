<?php
namespace Uspdev\LaravelTools;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Uspdev\LaravelTools\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-tools.php', 'laravel-tools');

        $this->mergeConfigFrom(__DIR__ . '/../config/filesystems.php', 'filesystems.disks');

        $dbSnapshotsConfig = include __DIR__ . '/../config/db-snapshots.php';
        Config::set('db-snapshots', $dbSnapshotsConfig);

        // registra eventos
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // php artisan vendor:publish --provider="Uspdev\LaravelTools\AppServiceProvider" --tag="config"
            $this->publicarConfig();
        }

        if (config('laravel-tools.forcarHttps')) {
            $this->configForcarHttps();
        }

        if (config('laravel-tools.prefix')) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-tools');
            $this->registerRoutes();
        }
    }

    /**
     * Força o uso de https.
     */
    protected function configForcarHttps()
    {
        URL::forceScheme('https');
    }

    /**
     * publica o arquivo de configuração
     *
     * php artisan vendor:publish --provider="Uspdev\LaravelTools\AppServiceProvider" --tag="config"
     */
    protected function publicarConfig()
    {
        $this->publishes([__DIR__ . '/../config/laravel-tools.php' => config_path('laravel-tools.php')], 'config');
    }

    protected function registerRoutes()
    {
        Route::group(
            [
                'prefix' => config('laravel-tools.prefix'),
                // 'middleware' => 'web',
                'middleware' => ['web', 'can:admin'],
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
    }
}

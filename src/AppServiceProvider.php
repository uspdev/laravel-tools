<?php
namespace Uspdev\LaravelTools;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-tools.php', 'laravel-tools');
    }

    public function boot()
    {
        $this->configForcarHttps();
        $this->publicarConfig();
    }

    protected function configForcarHttps()
    {
        if (config('laravel-tools.forcarHttps')) {
            URL::forceScheme('https');
        }
    }

    /**
     * publica o arquivo de configuração
     *
     * php artisan vendor:publish --provider="Uspdev\LaravelTools\AppServiceProvider" --tag="config"
     */
    protected function publicarConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/laravel-tools.php' => config_path('laravel-tools.php')], 'config');
        }
    }
}

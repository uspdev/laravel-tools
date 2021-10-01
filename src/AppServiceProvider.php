<?php
namespace Uspdev\LaravelTools;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'LaravelTools');
    }

    public function boot()
    {

        $this->configForcarHttps();
        $this->publicarConfig();

    }

    protected function configForcarHttps()
    {
        if (config('laravelTools.forcarHttps')) {
            \URL::forceScheme('https');
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
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('LaravelTools.php')], 'config');
        }
    }
}

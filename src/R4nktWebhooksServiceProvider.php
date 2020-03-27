<?php

namespace R4nkt\LaravelWebhooks;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class R4nktWebhooksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/r4nkt-webhooks.php' => config_path('r4nkt-webhooks.php'),
            ], 'config');
        }

        Route::macro('r4nktWebhooks', function ($url) {
            return Route::post($url, '\R4nkt\LaravelWebhooks\R4nktWebhooksController');
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/r4nkt-webhooks.php', 'r4nkt-webhooks');
    }
}

<?php

namespace Molitor\Gallery\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'gallery');

        $this->publishes([
            __DIR__.'/../../config/gallery.php' => config_path('gallery.php'),
        ], 'gallery-config');

        // Load API routes
        $this->app->make(Router::class)
            ->group([
                'prefix' => 'api',
                'middleware' => ['api'],
            ], __DIR__.'/../routes/api.php');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/gallery.php', 'gallery');

        // Repositories will be bound here
    }
}

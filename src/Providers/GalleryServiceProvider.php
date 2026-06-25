<?php

namespace Molitor\Gallery\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Molitor\Cms\Services\ContentHandler;
use Molitor\Gallery\Repositories\GalleryRepository;
use Molitor\Gallery\Repositories\GalleryRepositoryInterface;
use Molitor\Gallery\Services\ContentElementTypes\GalleryElementType;

class GalleryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'gallery');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'gallery');

        $this->publishes([
            __DIR__.'/../../config/gallery.php' => config_path('gallery.php'),
            __DIR__.'/../../resources/views' => resource_path('views/vendor/gallery'),
        ], 'gallery-resources');

        // Load API routes
        $this->app->make(Router::class)
            ->group([
                'prefix' => 'api',
                'middleware' => ['api'],
            ], __DIR__.'/../routes/api.php');

        // Load Web routes
        $this->app->make(Router::class)
            ->group([
                'middleware' => ['web'],
            ], __DIR__.'/../routes/web.php');

        $this->app->booted(function () {
            if ($this->app->bound(ContentHandler::class)) {
                $this->app->make(ContentHandler::class)->registerElementType(new GalleryElementType);
            }
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/gallery.php', 'gallery');

        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
    }
}

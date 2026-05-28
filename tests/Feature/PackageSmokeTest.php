<?php

namespace Molitor\Gallery\Tests\Feature;

use Molitor\Gallery\Providers\GalleryServiceProvider;
use Tests\TestCase;

class PackageSmokeTest extends TestCase
{
    public function test_service_provider_is_loaded(): void
    {
        $this->assertTrue(class_exists(GalleryServiceProvider::class));
        $this->assertTrue($this->app->providerIsLoaded(GalleryServiceProvider::class));
    }
}


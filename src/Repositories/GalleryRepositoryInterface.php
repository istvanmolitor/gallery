<?php

declare(strict_types=1);

namespace Molitor\Gallery\Repositories;

use Molitor\Gallery\Models\Gallery;

interface GalleryRepositoryInterface
{
    /**
     * @param array<int, array<string, mixed>> $images
     */
    public function create(string $name, string $slug, ?string $description, array $images = []): Gallery;
}


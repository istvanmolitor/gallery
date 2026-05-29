<?php

declare(strict_types=1);

namespace Molitor\Gallery\Repositories;

use Molitor\Gallery\Models\Gallery;

class GalleryRepository implements GalleryRepositoryInterface
{
    private Gallery $gallery;

    public function __construct()
    {
        $this->gallery = new Gallery;
    }

    /**
     * @param array<int, array<string, mixed>> $images
     */
    public function create(string $name, string $slug, ?string $description, array $images = []): Gallery
    {
        $gallery = $this->gallery->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);

        foreach ($images as $image) {
            $gallery->images()->create($image);
        }

        return $gallery;
    }
}


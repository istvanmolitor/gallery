<?php

namespace Molitor\Gallery\Services;

use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;

class GalleryMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        if ($name === 'admin') {
            $galleryGroup = $menu->addItem('Média', null);
            $galleryGroup->setName('media_group');
            $galleryGroup->setIcon('photo-video');

            $galleryGroup->addItem('Galériák', '/admin/gallery')
                ->setName('gallery.index')
                ->setIcon('images');
        }
    }
}

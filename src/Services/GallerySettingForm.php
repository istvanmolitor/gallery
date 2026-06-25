<?php

declare(strict_types=1);

namespace Molitor\Gallery\Services;

use Molitor\Setting\Enums\SettingFieldType;
use Molitor\Setting\Services\SettingForm;
use Molitor\Theme\Services\LayoutService;

class GallerySettingForm extends SettingForm
{
    public function getSlug(): string
    {
        return 'gallery';
    }

    public function getLabel(): string
    {
        return 'Galéria';
    }

    public function getFields(): array
    {
        return [
            'gallery_layout' => [
                'label' => 'Galéria oldal layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
        ];
    }

    private function getLayoutOptions(): array
    {
        $options = [];
        foreach (app(LayoutService::class)->getLayouts() as $key => $layout) {
            $options[] = ['value' => $key, 'label' => $layout['name']];
        }

        return $options;
    }
}

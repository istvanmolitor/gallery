<?php

namespace Molitor\Gallery\Services\ContentElementTypes;

use Molitor\Cms\Services\ContentElementTypes\BaseContentElementType;

class GalleryElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'gallery';
    }

    public function getPackage(): string
    {
        return 'gallery';
    }

    public function getLabel(): string
    {
        return __('Gallery');
    }

    public function prepare(array $data): array
    {
        return [
            'gallery_id' => isset($data['gallery_id']) ? (int) $data['gallery_id'] : null,
            'columns' => isset($data['columns']) ? (int) $data['columns'] : 3,
            'show_title' => isset($data['show_title']) ? (bool) $data['show_title'] : false,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'gallery_id' => 'required|integer|exists:galleries,id',
            'columns' => 'required|integer|in:1,2,3,4',
            'show_title' => 'boolean',
        ];
    }

}

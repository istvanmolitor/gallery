<?php

namespace Molitor\Gallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $galleryId = $this->route('gallery')?->id ?? $this->route('gallery');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:galleries,slug,'.$galleryId],
            'description' => ['nullable', 'string'],
            'images' => ['nullable', 'array'],
            'images.*.image_url' => ['required', 'string'],
            'images.*.title' => ['nullable', 'string', 'max:255'],
            'images.*.order' => ['nullable', 'integer'],
        ];
    }
}

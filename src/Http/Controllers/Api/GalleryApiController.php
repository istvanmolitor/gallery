<?php

namespace Molitor\Gallery\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Molitor\Gallery\DataTables\GalleryDataTable;
use Molitor\Gallery\Http\Requests\StoreGalleryRequest;
use Molitor\Gallery\Http\Requests\UpdateGalleryRequest;
use Molitor\Gallery\Http\Resources\GalleryResource;
use Molitor\Gallery\Models\Gallery;
use Molitor\Gallery\Repositories\GalleryRepositoryInterface;

class GalleryApiController extends Controller
{
    public function __construct(
        private GalleryRepositoryInterface $galleryRepository
    ) {}

    public function index(GalleryDataTable $dataTable): AnonymousResourceCollection
    {
        return $dataTable->getResponse();
    }

    public function store(StoreGalleryRequest $request): GalleryResource
    {
        $validated = $request->validated();

        $gallery = $this->galleryRepository->create(
            $validated['name'],
            $validated['slug'],
            $validated['description'] ?? null,
            $validated['images'] ?? [],
        );

        return new GalleryResource($gallery->load('images'));
    }

    public function show(Gallery $gallery): GalleryResource
    {
        return new GalleryResource($gallery->load('images'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): GalleryResource
    {
        $gallery->update($request->validated());

        if ($request->has('images')) {
            $gallery->images()->delete();
            foreach ($request->input('images') as $image) {
                $gallery->images()->create($image);
            }
        }

        return new GalleryResource($gallery->load('images'));
    }

    public function destroy(Gallery $gallery): Response
    {
        $gallery->delete();

        return response()->noContent();
    }
}



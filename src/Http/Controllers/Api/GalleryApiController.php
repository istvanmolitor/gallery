<?php

namespace Molitor\Gallery\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Molitor\Gallery\Http\Requests\StoreGalleryRequest;
use Molitor\Gallery\Http\Requests\UpdateGalleryRequest;
use Molitor\Gallery\Http\Resources\GalleryResource;
use Molitor\Gallery\Models\Gallery;

class GalleryApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $galleries = Gallery::with('images')->latest()->paginate();

        return GalleryResource::collection($galleries);
    }

    public function store(StoreGalleryRequest $request): GalleryResource
    {
        $gallery = Gallery::create($request->validated());

        if ($request->has('images')) {
            foreach ($request->input('images') as $image) {
                $gallery->images()->create($image);
            }
        }

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

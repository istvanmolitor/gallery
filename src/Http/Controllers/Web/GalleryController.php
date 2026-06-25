<?php

namespace Molitor\Gallery\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Molitor\Gallery\Models\Gallery;
use Molitor\Gallery\Services\GallerySettingForm;
use Molitor\Theme\Services\LayoutService;

class GalleryController extends Controller
{
    public function __construct(
        private GallerySettingForm $gallerySettingForm,
        private LayoutService $layoutService,
    ) {}

    public function show(Gallery $gallery, ?int $image = null): View
    {
        $images = $gallery->images()->get();
        $currentImage = $image
            ? $gallery->images()->find($image)
            : $images->first();

        if ($image && ! $currentImage) {
            abort(404);
        }

        $currentIndex = $images->search(fn ($img) => $img->id === $currentImage->id);
        $prevImage = $currentIndex > 0 ? $images[$currentIndex - 1] : null;
        $nextImage = $currentIndex < $images->count() - 1 ? $images[$currentIndex + 1] : null;

        // Csak 4 kis képet mutatunk: az aktuálisat és a környezetét, vagy csak az első 4-et
        // A kérés szerint "Maximum 4 kép", valószínűleg a lista hossza a lényeg
        $thumbnails = $images->take(4);

        $layoutName = $this->gallerySettingForm->get('gallery_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return view('gallery::show', compact('gallery', 'images', 'currentImage', 'prevImage', 'nextImage', 'thumbnails', 'layout'));
    }
}

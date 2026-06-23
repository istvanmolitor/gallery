<?php

use Illuminate\Support\Facades\Route;
use Molitor\Gallery\Http\Controllers\Web\GalleryController;

Route::middleware(['web'])->group(function () {
    Route::get('/gallery/{gallery:slug}/{image?}', [GalleryController::class, 'show'])->name('gallery.show');
});

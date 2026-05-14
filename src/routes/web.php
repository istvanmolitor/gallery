<?php

use Illuminate\Support\Facades\Route;
use Molitor\Gallery\Http\Controllers\Web\GalleryController;

Route::get('/gallery/{gallery:slug}/{image?}', [GalleryController::class, 'show'])->name('gallery.show');

<?php

use Illuminate\Support\Facades\Route;
use Molitor\Gallery\Http\Controllers\Api\GalleryApiController;

Route::apiResource('galleries', GalleryApiController::class);

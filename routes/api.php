<?php

use App\Http\Controllers\Api\PlaceController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'places' => PlaceController::class,
]);

Route::get('places-search', [PlaceController::class, 'searchName']);

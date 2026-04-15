<?php

use App\Http\Controllers\Api\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| php artisan route:list
|--------------------------------------------------------------------------
*/
// GET: localhost:8000/api/places
// POST: localhost:8000/api/places
// GET: localhost:8080/api/places-search?name=
// GET: localhost:8000/api/places/id
// PUT/PATCH: localhost:8000/api/places/id
// DELETE: localhost:8000/api/places/id

Route::apiResources([
    'places' => PlaceController::class,
]);

Route::get('places-search', [PlaceController::class, 'searchName']);

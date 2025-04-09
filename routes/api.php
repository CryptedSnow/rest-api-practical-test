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
// GET: localhost:8000/api/place
// POST: localhost:8000/api/place
// GET: localhost:8080/api/place-search?name=
// GET: localhost:8000/api/place/id
// PUT: localhost:8000/api/place/id
// DELETE: localhost:8000/api/place/id

Route::apiResources([
    'place' => PlaceController::class,
]);

Route::get('place-search', [PlaceController::class, 'searchName']);

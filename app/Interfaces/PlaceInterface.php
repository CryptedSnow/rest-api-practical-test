<?php

namespace App\Interfaces;

use App\Models\Place;
use Illuminate\Pagination\LengthAwarePaginator;

interface PlaceInterface
{
    public function listPlaces(int $perPage = 10): LengthAwarePaginator;
    public function findPlaceId(int $id): ?Place;
    public function createPlace(array $data): Place;
    public function updatePlace(Place $place, array $data): Place;
    public function deletePlace(Place $place): bool;
    public function searchPlaceName(string $name, int $perPage = 10): LengthAwarePaginator;
    public function generateSlug(string $name, int $id): string;
    public function slugExists(string $slug, int $excludeId): bool;
}

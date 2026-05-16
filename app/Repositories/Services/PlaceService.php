<?php

namespace App\Repositories\Services;

use App\Models\Place;
use App\Repositories\Interfaces\PlaceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PlaceService implements PlaceInterface
{
    public function listPlaces(int $perPage = 5): LengthAwarePaginator
    {
        return Place::paginate($perPage);
    }

    public function findPlaceId(int $id): ?Place
    {
        return Place::find($id);
    }

    public function createPlace(array $data): Place
    {
        return Place::create($data);
    }

    public function updatePlace(Place $place, array $data): Place
    {
        $place->update($data);
        return $place->fresh();
    }

    public function deletePlace(Place $place): bool
    {
        return $place->delete();
    }

    public function searchPlaceName(string $name, int $perPage = 5): LengthAwarePaginator
    {
        return Place::where('name', 'ILIKE', "%{$name}%")->paginate($perPage);
    }

    public function generateSlug(string $name, int $id = 0): string
    {
        $baseSlug = Str::slug($name);

        if (!$this->slugExists($baseSlug, $id)) {
            return $baseSlug;
        }

        return $baseSlug . '-' . $id;
    }

    public function slugExists(string $slug, int $excludeId = 0): bool
    {
        return Place::where('slug', $slug)->where('id', '!=', $excludeId)->exists();
    }

}

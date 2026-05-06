<?php

namespace App\Repositories\Eloquent;

use App\Models\Place;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PlaceRepository implements PlaceRepositoryInterface
{
    public function getAllPaginated(int $perPage = 5): LengthAwarePaginator
    {
        return Place::paginate($perPage);
    }

    public function findById(int $id): ?Place
    {
        return Place::find($id);
    }

    public function create(array $data): Place
    {
        return Place::create($data);
    }

    public function update(Place $place, array $data): Place
    {
        $place->update($data);
        return $place->fresh();
    }

    public function delete(Place $place): bool
    {
        return $place->delete();
    }

    public function searchName(string $name, int $perPage = 5): LengthAwarePaginator
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

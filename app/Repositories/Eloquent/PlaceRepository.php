<?php

namespace App\Repositories\Eloquent;

use App\Models\Place;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

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

}

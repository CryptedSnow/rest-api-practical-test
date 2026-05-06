<?php

namespace App\Repositories\Contracts;

use App\Models\Place;
use Illuminate\Pagination\LengthAwarePaginator;

interface PlaceRepositoryInterface
{
    public function getAllPaginated(int $perPage = 5): LengthAwarePaginator;
    public function findById(int $id): ?Place;
    public function create(array $data): Place;
    public function update(Place $place, array $data): Place;
    public function delete(Place $place): bool;
    public function searchName(string $name, int $perPage = 5): LengthAwarePaginator;
    public function generateSlug(string $name, int $id): string;
    public function slugExists(string $slug, int $excludeId): bool;
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{PlaceStoreRequest, PlaceUpdateRequest};
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    public function __construct(
        private readonly PlaceRepositoryInterface $repository
    ) {}

    public function index(): AnonymousResourceCollection | JsonResponse
    {
        $places = $this->repository->getAllPaginated(5);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => 'Places was not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

    public function store(PlaceStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $place = $this->repository->create($data);

        return response()->json([
            'message' => "Place $place->name was created.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): PlaceResource | JsonResponse
    {
        $place = $this->repository->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        return new PlaceResource($place);
    }

    public function update(PlaceUpdateRequest $request, int $id): JsonResponse
    {
        $place = $this->repository->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $request->validated();

        if (array_key_exists('name', $data) && !empty($data['name'])) {

            $baseSlug = Str::slug($data['name']);

            $existingSlug = Place::where('slug', $baseSlug)->where('id', '!=', $id)->exists();

            if ($existingSlug) {
                $data['slug'] = $baseSlug . '-' . $id;
            } else {
                $data['slug'] = $baseSlug;
            }
        }

        $place = $this->repository->update($place, $data);

        return response()->json([
            'message' => "Place $place->name was updated.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id): JsonResponse
    {
        $place = $this->repository->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $this->repository->delete($place);

        return response()->json([
            'message' => "Place $place->name was deleted."
        ], Response::HTTP_OK);
    }

    public function searchName(Request $request): AnonymousResourceCollection | JsonResponse
    {
        $namePlace = $request->query('name');

        if (!$namePlace) {
            return response()->json([
                'message' => 'The name field is empty.'
            ], Response::HTTP_BAD_REQUEST);
        }

        $places = $this->repository->searchName(trim($namePlace), 5);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => "No places found using the name $places."
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{PlaceStoreRequest, PlaceUpdateRequest};
use App\Http\Resources\PlaceResource;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    public function __construct(protected PlaceRepositoryInterface $placeRepositoryInterface) {}

    public function index(): AnonymousResourceCollection | JsonResponse
    {
        $places = $this->placeRepositoryInterface->getAllPaginated(5);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => 'Places was not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

    public function store(PlaceStoreRequest $request): JsonResponse
    {
        $validations = $request->validated();

        $validations['slug'] = $this->placeRepositoryInterface->generateSlug($validations['name'], 0);

        $place = $this->placeRepositoryInterface->create($validations);

        return response()->json([
            'message' => "Place $place->name was created.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): PlaceResource | JsonResponse
    {
        $place = $this->placeRepositoryInterface->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        return new PlaceResource($place);
    }

    public function update(PlaceUpdateRequest $request, int $id): JsonResponse
    {
        $place = $this->placeRepositoryInterface->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $validations = $request->validated();

        if (array_key_exists('name', $validations) && !empty($validations['name'])) {
            $validations['slug'] = $this->placeRepositoryInterface->generateSlug($validations['name'], $id);
        }

        $place = $this->placeRepositoryInterface->update($place, $validations);

        return response()->json([
            'message' => "Place $place->name was updated.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id): JsonResponse
    {
        $place = $this->placeRepositoryInterface->findById($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $this->placeRepositoryInterface->delete($place);

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

        $places = $this->placeRepositoryInterface->searchName($namePlace);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => "No places found using the name $places."
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

}

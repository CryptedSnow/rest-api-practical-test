<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PlaceInterface;
use App\Http\Requests\{PlaceStoreRequest, PlaceUpdateRequest};
use App\Http\Resources\PlaceResource;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class PlaceController extends Controller
{
    public function __construct(private PlaceInterface $placeInterface) {}

    #[OA\Get(
        path: '/places',
        summary: 'List all places',
        tags: ['Places'],
        parameters: [
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number',
                schema: new OA\Schema(type: 'integer', example: 1)
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: 'All places retrieved'),
            new OA\Response(response: 404, description: 'No places found'),
        ]
    )]
    public function index(): AnonymousResourceCollection | JsonResponse
    {
        $places = $this->placeInterface->listPlaces(5);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => 'Places was not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

    #[OA\Post(
        path: '/places',
        summary: 'Create a new place',
        tags: ['Places'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'state', 'city'],
                properties: [
                    new OA\Property(property: 'name',  type: 'string', example: 'Gold Saucer'),
                    new OA\Property(property: 'state', type: 'string', example: 'Square Enix'),
                    new OA\Property(property: 'city',  type: 'string', example: 'Final Fantasy VII'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Place created'),
            new OA\Response(response: 422, description: 'Invalid data'),
        ]
    )]
    public function store(PlaceStoreRequest $request): JsonResponse
    {
        $validations = $request->validated();

        $validations['slug'] = $this->placeInterface->generateSlug($validations['name'], 0);

        $place = $this->placeInterface->createPlace($validations);

        return response()->json([
            'message' => "Place $place->name was created.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_CREATED);
    }

    #[OA\Get(
        path: '/places/{id}',
        summary: 'Show place by ID',
        tags: ['Places'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Place found'),
            new OA\Response(response: 404, description: 'Place not found'),
        ]
    )]
    public function show(int $id): PlaceResource | JsonResponse
    {
        $place = $this->placeInterface->findPlaceId($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        return new PlaceResource($place);
    }

    #[OA\Put(
        path: '/places/{id}',
        summary: 'Update place',
        tags: ['Places'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name',  type: 'string', example: 'Gold Saucer'),
                    new OA\Property(property: 'state', type: 'string', example: 'Square Enix'),
                    new OA\Property(property: 'city',  type: 'string', example: 'Final Fantasy VII Rebirth'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 202, description: 'Place updated'),
            new OA\Response(response: 404, description: 'Place not found'),
        ]
    )]
    public function update(PlaceUpdateRequest $request, int $id): JsonResponse
    {
        $place = $this->placeInterface->findPlaceId($id);

        if (!$place) {
            return response()->json([
                'message' => "Place $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $validations = $request->validated();

        if (array_key_exists('name', $validations) && !empty($validations['name'])) {
            $validations['slug'] = $this->placeInterface->generateSlug($validations['name'], $id);
        }

        $place = $this->placeInterface->updatePlace($place, $validations);

        return response()->json([
            'message' => "Place $place->name was updated.",
            'data'    => new PlaceResource($place)
        ], Response::HTTP_ACCEPTED);
    }

    #[OA\Delete(
        path: '/places/{id}',
        summary: 'Delete place',
        tags: ['Places'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Place deleted'),
            new OA\Response(response: 404, description: 'Place not found'),
        ]
    )]
    public function destroy(int $id): JsonResponse
    {
        $place = $this->placeInterface->findPlaceId($id);

        if (!$place) {
            return response()->json([
                'message' => "Place ID $id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        $this->placeInterface->deletePlace($place);

        return response()->json([
            'message' => "Place $place->name was deleted."
        ], Response::HTTP_OK);
    }

    #[OA\Get(
        path: '/places-search',
        summary: 'Search places by name',
        tags: ['Places'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                in: 'query',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number',
                schema: new OA\Schema(type: 'integer', example: 1)
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Results found'),
            new OA\Response(response: 404, description: 'No results found'),
        ]
    )]
    public function searchName(Request $request): AnonymousResourceCollection | JsonResponse
    {
        $namePlace = $request->query('name');

        if (!$namePlace) {
            return response()->json([
                'message' => 'The name field is empty.'
            ], Response::HTTP_NOT_FOUND);
        }

        $places = $this->placeInterface->searchPlaceName($namePlace);

        if ($places->isEmpty()) {
            return response()->json([
                'message' => "No places found using the name $namePlace or the requested page has no results."
            ], Response::HTTP_NOT_FOUND);
        }

        return PlaceResource::collection($places);
    }

}

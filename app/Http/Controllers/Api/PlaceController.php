<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Http\Resources\PlaceResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::orderBy('id')->paginate(5);
        if ($places->isEmpty()) {
            return response()->json(['message' => 'No places found.'], 404);
        }
        return PlaceResource::collection($places);
    }

    public function store(Request $request)
    {
        try {
            $validations = $request->validate([
                'name' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
            ]);
            $validations['slug'] = Str::slug($validations['name']);
            $treatedData = array_map(
                fn($value) => is_string($value) ? trim($value) : $value, $validations
            );
            $place = Place::create($treatedData);
            return (new PlaceResource($place))->response()->setStatusCode(201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(['message' => "Place ID $id not found to show."], 404);
        }
        return new PlaceResource($place);
    }

    public function update(Request $request, $id)
    {
        try {
            $place = Place::find($id);
            if (!$place) {
                return response()->json(['message' => "Place ID $id not found to update."], 404);
            }
            $validations = $request->validate([
                'name' => 'sometimes|required|string',
                'state' => 'sometimes|required|string',
                'city' => 'sometimes|required|string',
            ]);
            if (isset($validations['name'])) {
                $validations['slug'] = Str::slug($validations['name']);
            }
            $treatedData = array_map(
                fn($value) => is_string($value) ? trim($value) : $value, $validations
            );
            $place->update($treatedData);
            return (new PlaceResource($place))->response()->setStatusCode(202);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(['message' => "Place ID $id not found to delete."], 404);
        }
        $place->delete();
        return response()->json(['message' => "$place->name is deleted."], 200);
    }

    public function searchName(Request $request)
    {
        $name = $request->input('name');
        if (!$name) {
            return response()->json(['message' => "The name field is empty."], 404);
        }
        $places = Place::where('name', 'ILIKE', '%' . $name . '%')->orderby('id')->paginate(5);
        if ($places->isEmpty()) {
            return response()->json(['message' => "No places found using the name $name."], 404);
        }
        return PlaceResource::collection($places);
    }

}

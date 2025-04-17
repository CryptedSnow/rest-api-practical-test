<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaceModel;
use App\Http\Resources\PlaceResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    public function index()
    {
        $places = PlaceModel::all();
        if ($places->isEmpty()) {
            return response()->json(['message' => 'No places found.'], 404);
        }
        return PlaceResource::collection($places);
    }

    public function store(Request $request)
    {
        try {
            $validations = $request->validate([
                'name' => 'required',
                'state' => 'required',
                'city' => 'required',
            ]);
            $validations['slug'] = Str::slug($validations['name']);
            $treated_data = [
                'name' => trim((string) $validations['name']),
                'slug' => trim((string) $validations['slug']),
                'state' => trim((string) $validations['state']),
                'city' => trim((string) $validations['city']),
            ];
            $place = PlaceModel::create($treated_data);
            return (new PlaceResource($place))->response()->setStatusCode(201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $place = PlaceModel::find($id);
        if (!$place) {
            return response()->json(['message' => 'Place ID not found to show.'], 404);
        }
        return new PlaceResource($place);
    }

    public function update(Request $request, $id)
    {
        try {
            $place = PlaceModel::find($id);
            if (!$place) {
                return response()->json(['message' => 'Place ID not found to update.'], 404);
            }
            $validations = $request->validate([
                'name' => 'required',
                'state' => 'required',
                'city' => 'required',
            ]);
            $validations['slug'] = Str::slug($validations['name']);
            $treated_data = [
                'name' => trim((string) $validations['name']),
                'slug' => trim((string) $validations['slug']),
                'state' => trim((string) $validations['state']),
                'city' => trim((string) $validations['city']),
            ];
            $place->update($treated_data);
            return new PlaceResource($place);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $place = PlaceModel::find($id);
        if (!$place) {
            return response()->json(['message' => 'Place ID not found to delete.'], 404);
        }
        $place_name = $place->name;
        $place->delete();
        return response()->json(['message' => "$place_name is deleted."], 200);
    }

    public function searchName(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $name = $request->input('name');
        $places = PlaceModel::where('name', 'ILIKE', '%' . $name . '%')->get();
        if ($places->isEmpty()) {
            return response()->json(['message' => "No places found using the name $name."], 404);
        }
        return PlaceResource::collection($places);
    }

}

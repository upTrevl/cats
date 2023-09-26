<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreedRequest;
use App\Http\Requests\UpdateBreedRequest;
use App\Models\Breed;
use App\Models\Cat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BreedController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Breeds/BreedsTable');
    }

    public function search(Request $request)
    {
        if (!$request->search_query) {
            return Breed::all();
        }

        return Breed::where('name', 'like', '%' . $request->search_query . '%')->get();
    }

    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $total = Breed::count();
        $page = $request->page;
        $items = Breed::skip(10 * ($page - 1))->limit(10)->get();

        return response()->json([
            'total' => $total,
            'page' => $page,
            'items' => $items
        ]);
    }

    public function store(StoreBreedRequest $request): JsonResponse
    {
        $breed = new Breed();
        $breed->name = $request->name;
        $breed->description = $request->description;
        $breed->avg_age = $request->avg_age;
        $breed->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function update(UpdateBreedRequest $request, Breed $breed): JsonResponse|RedirectResponse
    {
        $breed = Breed::find($request->id);
        if (!$breed) {
            return back()->withErrors('breed_not_found');
        }

        $breed->name = $request->name;
        $breed->description = $request->description;
        $breed->avg_age = $request->avg_age;

        $breed->save();

        return response()->json([
            'success' => true,
        ]);
    }


    public function destroy(Breed $breed, int $breedId)
    {
        $breed = Breed::find($breedId);
        if(!$breed){
            return back()->withErrors('breed_not_found');
        }

        $breed->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}

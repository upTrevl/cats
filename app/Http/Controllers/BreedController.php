<?php

namespace App\Http\Controllers;

use App\Entities\BreedEntity;
use App\Http\Requests\StoreBreedRequest;
use App\Http\Requests\UpdateBreedRequest;
use App\Models\Breed;
use App\Repositories\BreedsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BreedController extends Controller
{
    public function __construct(
        private readonly BreedsRepository $breedsRepository
    )
    {
    }

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
        $breedEntity = new BreedEntity(
            id: null,
            name: $request->name,
            description: $request->description,
            avg_age: $request->avg_age
        );
        $this->breedsRepository->store($breedEntity);

        return response()->json([
            'success' => true,
        ]);
    }

    public function update(UpdateBreedRequest $request): JsonResponse|RedirectResponse
    {
        $breedEntity = new BreedEntity(
            id: $request->id,
            name: $request->name,
            description: $request->description,
            avg_age: $request->avg_age
        );

        $breed = $this->breedsRepository->update($breedEntity);
        if (!$breed) {
            return back()->withErrors('breed_not_found');
        }

        return response()->json([
            'success' => true,
        ]);
    }


    public function destroy(Request $request, int $breedId): JsonResponse|RedirectResponse
    {
        $breed = Breed::find($breedId);
        if (!$breed) {
            return back()->withErrors('breed_not_found');
        }

        $breed->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}

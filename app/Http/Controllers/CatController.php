<?php

namespace App\Http\Controllers;

use App\Entities\CatEntity;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use App\Models\Cat;
use App\Repositories\CatsRepository;
use App\Repositories\FilesRepository;
use App\Services\Images\CatsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CatController extends Controller
{
    public function __construct(
        private readonly CatsService     $catsService,
        private readonly CatsRepository  $catsRepository,
        private readonly FilesRepository $filesRepository,
    )
    {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Cats/CatsTable');
    }

    public function get(Request $request): JsonResponse
    {
        $total = Cat::count();
        $page = $request->page;
        $items = Cat::with(['breed', 'image'])->skip(10 * ($page - 1))->limit(10)->get();

        return response()->json([
            'total' => $total,
            'page' => $page,
            'items' => $items
        ]);
    }

    public function store(StoreCatRequest $request): JsonResponse
    {
        $catEntity = new CatEntity(
            id: null,
            name: $request->name,
            breed_id: $request->breed_id,
            age: $request->age,
            file_id: $request->file_id
        );
        $this->catsRepository->store($catEntity);

        return response()->json([
            'success' => true,
        ]);
    }


    public function update(UpdateCatRequest $request): JsonResponse|RedirectResponse
    {
        $catEntity = new CatEntity(
            id: $request->id,
            name: $request->name,
            breed_id: $request->breed_id,
            age: $request->age,
            file_id: $request->file_id
        );
        $cat = $this->catsRepository->update($catEntity);
        if (!$cat) {
            return back()->withErrors('cat_not_found');
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Request $request, int $catId): JsonResponse|RedirectResponse
    {
        $cat = Cat::find($catId);
        if (!$cat) {
            return back()->withErrors('cat_not_found');
        }

        $cat->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function getRandomImage(Request $request): \App\Models\File
    {
        $fileEntity = $this->catsService->getRandomImage();
        return $this->filesRepository->store($fileEntity);
    }
}

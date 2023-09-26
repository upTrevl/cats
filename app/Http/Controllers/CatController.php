<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use App\Models\Cat;
use App\Services\Images\CatsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class CatController extends Controller
{
    public function __construct(private readonly CatsService $catsService)
    {
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
        $cat = new Cat();
        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->breed_id = $request->breed_id;
        $cat->image_id = $request->file_id;

        $cat->save();

        return response()->json([
            'success' => true,
        ]);
    }


    public function update(UpdateCatRequest $request): JsonResponse|RedirectResponse
    {
        $cat = Cat::find($request->id);
        if (!$cat) {
            return back()->withErrors('cat_not_found');
        }

        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->breed_id = $request->breed_id;
        $cat->image_id = $request->file_id;

        $cat->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Request $request, int $catId): JsonResponse|RedirectResponse
    {
        $cat = Cat::find($catId);
        if(!$cat){
            return back()->withErrors('cat_not_found');
        }

        $cat->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function getRandomImage(Request $request): \App\Models\File
    {
        return $this->catsService->getRandomImage();
    }
}

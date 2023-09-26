<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Services\Images\CatsService;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    public function __construct(private readonly CatsService $catsService)
    {
    }

    public function run(): void
    {
        $breeds = $this->catsService->getBreeds();

        foreach ($breeds as $breed) {
            $lifeSpan = explode(" - ", $breed['life_span']);
            $avgAge = array_sum($lifeSpan) / 2;

            $breedModel = new Breed();
            $breedModel->name = $breed['name'];
            $breedModel->description = $breed['description'];
            $breedModel->avg_age = $avgAge;

            $breedModel->save();
        }
    }
}

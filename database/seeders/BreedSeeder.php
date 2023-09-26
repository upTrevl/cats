<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Repositories\BreedsRepository;
use App\Services\Images\CatsService;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    public function __construct(
        private readonly CatsService      $catsService,
        private readonly BreedsRepository $breedsRepository,
    )
    {
    }

    public function run(): void
    {
        $breedEntities = $this->catsService->getBreeds();

        foreach ($breedEntities as $breedEntity) {
            $this->breedsRepository->store($breedEntity);
        }
    }
}

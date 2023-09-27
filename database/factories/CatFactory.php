<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Repositories\FilesRepository;
use App\Services\Images\CatsService;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    const MAX_CATS_AGE = 20;

    public function definition(): array
    {
        $catsService = app()->make(CatsService::class);
        $filesRepository = app()->make(FilesRepository::class);

        $fileEntity = $catsService->getRandomImage();
        $file = $filesRepository->store($fileEntity);

        $age = random_int(1, self::MAX_CATS_AGE);
        $breed = Breed::inRandomOrder()->first();

        return [
            'name' => fake()->name(),
            'age' => $age,
            'breed_id' => $breed->id,
            'image_id' => $file->id
        ];
    }
}

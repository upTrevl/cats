<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    const MAX_CATS_AVG_AGE = 10;
    const MIN_CATS_AVG_AGE = 20;

    public function definition(): array
    {
        $randomInt = random_int(self::MIN_CATS_AVG_AGE, self::MAX_CATS_AVG_AGE);

        return [
            'name' => fake()->name(),
            'description' => fake()->text(100),
            'avg_age' => $randomInt,
        ];
    }
}

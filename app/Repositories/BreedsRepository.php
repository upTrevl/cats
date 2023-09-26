<?php

namespace App\Repositories;

use App\Entities\BreedEntity;
use App\Models\Breed;

class BreedsRepository
{
    public function store(BreedEntity $breedEntity): Breed
    {
        $breed = new Breed();

        $breed->name = $breedEntity->name;
        $breed->description = $breedEntity->description;
        $breed->avg_age = $breedEntity->avg_age;

        $breed->save();

        return $breed;
    }

    public function update(BreedEntity $breedEntity): ?Breed
    {
        $breed = Breed::find($breedEntity->id);
        if (!$breed) {
            return null;
        }

        $breed->name = $breedEntity->name;
        $breed->description = $breedEntity->description;
        $breed->avg_age = $breedEntity->avg_age;

        $breed->save();

        return $breed;
    }
}

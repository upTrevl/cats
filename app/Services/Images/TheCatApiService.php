<?php

namespace App\Services\Images;

use App\Entities\BreedEntity;
use App\Entities\FileEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TheCatApiService implements CatsService
{
    const GET_BREEDS_URL = 'https://api.thecatapi.com/v1/breeds?api_key=live_sq28Xkx1T1i09uA9BLeLgIbStTx6A6a9pcjIzQxXbJOXl10LMEj2lrpwBob1e69S';
    const GET_RANDOM_IMAGE_URL = 'https://api.thecatapi.com/v1/images/search?api_key=live_sq28Xkx1T1i09uA9BLeLgIbStTx6A6a9pcjIzQxXbJOXl10LMEj2lrpwBob1e69S';

    public function getRandomImage(): FileEntity
    {
        $response = Http::get(self::GET_RANDOM_IMAGE_URL);
        $body = $response->body();

        $images = json_decode($body, true);
        $image = reset($images);

        $name = basename($image['url']);
        $contents = file_get_contents($image['url']);

        Storage::disk('cats')->put($name, $contents);

        return new FileEntity(
            id: null,
            name: $name,
            storage_name: Storage::disk('cats')->url($name),
            type: Storage::disk('cats')->mimeType($name)
        );
    }

    public function getBreeds(): Collection
    {
        $response = Http::get(self::GET_BREEDS_URL);
        $body = $response->body();
        $breeds = json_decode($body, true);
        $breedEntities = [];

        foreach ($breeds as $breed) {
            $lifeSpan = explode(" - ", $breed['life_span']);
            $avgAge = array_sum($lifeSpan) / 2;

            $breedEntities[] = new BreedEntity(
                id: null,
                name: $breed['name'],
                description: $breed['description'],
                avg_age: $avgAge
            );
        }

        return collect($breedEntities);
    }
}

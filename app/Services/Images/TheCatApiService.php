<?php

namespace App\Services\Images;

use Illuminate\Http\File;
use App\Models\File as FileModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TheCatApiService implements CatsService
{
    const GET_BREEDS_URL = 'https://api.thecatapi.com/v1/breeds?api_key=live_sq28Xkx1T1i09uA9BLeLgIbStTx6A6a9pcjIzQxXbJOXl10LMEj2lrpwBob1e69S';
    const GET_RANDOM_IMAGE_URL = 'https://api.thecatapi.com/v1/images/search?api_key=live_sq28Xkx1T1i09uA9BLeLgIbStTx6A6a9pcjIzQxXbJOXl10LMEj2lrpwBob1e69S';

    public function getRandomImage(): FileModel
    {
        $response = Http::get(self::GET_RANDOM_IMAGE_URL);
        $body = $response->body();

        $images = json_decode($body, true);
        $image = reset($images);

        $name = basename($image['url']);
        $contents = file_get_contents($image['url']);

        Storage::disk('cats')->put($name, $contents);

        $fileModel = new FileModel();
        $fileModel->name = $name;
        $fileModel->storage_name = Storage::disk('cats')->url($name);
        $fileModel->type = Storage::disk('cats')->mimeType($name);
        $fileModel->save();

        return $fileModel;
    }

    public function getBreeds(): Collection
    {
        $response = Http::get(self::GET_BREEDS_URL);
        $body = $response->body();

        return collect(json_decode($body, true));
    }
}

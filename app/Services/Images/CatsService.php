<?php

namespace App\Services\Images;

use App\Models\File;
use Illuminate\Support\Collection;

interface CatsService
{
    public function getRandomImage(): File;

    public function getBreeds(): Collection;
}

<?php

namespace App\Services\Images;

use App\Entities\FileEntity;
use Illuminate\Support\Collection;

interface CatsService
{
    public function getRandomImage(): FileEntity;

    public function getBreeds(): Collection;
}

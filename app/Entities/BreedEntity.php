<?php

namespace App\Entities;

class BreedEntity
{
    public function __construct(
        public ?int   $id,
        public string $name,
        public string $description,
        public int    $avg_age,
    )
    {
    }
}

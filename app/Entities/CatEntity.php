<?php

namespace App\Entities;

class CatEntity
{
    public function __construct(
        public ?int   $id,
        public string $name,
        public int    $breed_id,
        public int    $age,
        public int    $file_id,
    )
    {
    }
}

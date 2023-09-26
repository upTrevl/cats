<?php

namespace App\Entities;

class FileEntity
{
    public function __construct(
        public ?int   $id,
        public string $name,
        public string $storage_name,
        public string $type,
    )
    {
    }
}

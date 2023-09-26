<?php

namespace App\Repositories;

use App\Entities\CatEntity;
use App\Models\Cat;

class CatsRepository
{
    public function store(CatEntity $catEntity): Cat
    {
        $cat = new Cat();

        $cat->name = $catEntity->name;
        $cat->age = $catEntity->age;
        $cat->breed_id = $catEntity->breed_id;
        $cat->image_id = $catEntity->file_id;

        $cat->save();

        return $cat;
    }

    public function update(CatEntity $catEntity): ?Cat
    {
        $cat = Cat::find($catEntity->id);
        if (!$cat) {
            return null;
        }
        $cat->name = $catEntity->name;
        $cat->age = $catEntity->age;
        $cat->breed_id = $catEntity->breed_id;
        $cat->image_id = $catEntity->file_id;

        $cat->save();

        return $cat;
    }
}

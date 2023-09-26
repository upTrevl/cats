<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{

    public function run(): void
    {
        Cat::factory()->count(50)->create();
    }
}

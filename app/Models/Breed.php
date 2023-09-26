<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $avg_age
 **/
class Breed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $age
 * @property int $breed_id
 * @property int $image_id
 *
 * @property Breed $breed
 **/
class Cat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['age_status'];

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'image_id');
    }

    public function ageStatus(): Attribute
    {
        $avgAge = $this->breed?->avg_age ?? 10;
        return new Attribute(
            get: fn() => match (true) {
                $this->age < ($avgAge - 2) => 'young',
                $this->age > ($avgAge + 2) => 'critical',
                default => 'old',
            }
        );
    }
}

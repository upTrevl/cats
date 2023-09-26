<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $storage_name
 * @property string $type
 **/
class File extends Model
{
    use HasFactory;

    protected $guarded = [];
}

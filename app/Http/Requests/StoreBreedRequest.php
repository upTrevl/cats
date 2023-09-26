<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name
 * @property-read int $avg_age
 * @property-read string $description
 */
class StoreBreedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:65535',
            'avg_age' => 'required|integer|min:1|max:30',
        ];
    }
}

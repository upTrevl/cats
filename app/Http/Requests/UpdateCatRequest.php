<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name
 * @property-read int $age
 * @property-read int $breed_id
 * @property-read int $file_id
 * @property-read int $id
 */

class UpdateCatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:cats,id',
            'name' => 'required|min:2|max:255',
            'age' => 'required|integer|min:1|max:30',
            'breed_id' => 'required|integer|exists:breeds,id',
            'file_id' => 'required|integer|exists:files,id',
        ];
    }
}

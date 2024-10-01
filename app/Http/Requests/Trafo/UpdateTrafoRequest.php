<?php

namespace App\Http\Requests\Trafo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrafoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_plate' => 'sometimes|string|max:255',
            'deklarasi' => 'sometimes|string',
            'available' => 'sometimes|boolean',
        ];
    }
}

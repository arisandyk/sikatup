<?php

namespace App\Http\Requests\Trafo;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrafoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_plate' => 'required|string|max:255',
            'deklarasi' => 'required|string',
            'available' => 'required|boolean',
        ];
    }
}

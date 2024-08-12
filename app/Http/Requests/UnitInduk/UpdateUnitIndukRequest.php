<?php

namespace App\Http\Requests\UnitInduk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitIndukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'direktorat_id' => 'sometimes|required|integer|exists:direktorat,id',
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\UnitInduk;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitIndukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'direktorat_id' => 'required|integer|exists:direktorat,id',
            'name' => 'required|string|max:255',
        ];
    }
}

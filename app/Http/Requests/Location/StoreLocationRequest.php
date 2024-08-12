<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gi_id' => 'required|integer|exists:gardu_induks,id',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gi_id' => 'sometimes|integer|exists:gardu_induks,id',
            'address' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string',
        ];
    }
}

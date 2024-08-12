<?php

namespace App\Http\Requests\Basecamp;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasecampRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'app_id' => 'sometimes|integer|exists:apps,id',
            'name' => 'sometimes|string|max:255',
        ];
    }
}

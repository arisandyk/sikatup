<?php

namespace App\Http\Requests\Basecamp;

use Illuminate\Foundation\Http\FormRequest;

class StoreBasecampRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'app_id' => 'required|integer|exists:apps,id',
            'name' => 'required|string|max:255',
        ];
    }
}

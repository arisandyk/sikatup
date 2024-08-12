<?php

namespace App\Http\Requests\Tegangan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeganganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
        ];
    }
}

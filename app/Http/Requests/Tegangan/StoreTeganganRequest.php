<?php

namespace App\Http\Requests\Tegangan;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeganganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\Direktorat;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirektoratRequest extends FormRequest
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

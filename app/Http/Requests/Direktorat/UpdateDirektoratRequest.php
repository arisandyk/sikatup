<?php

namespace App\Http\Requests\Direktorat;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDirektoratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}

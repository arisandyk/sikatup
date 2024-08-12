<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SaveWorkplaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_induk_id' => 'required|exists:unit_induk,id',
            'app_id' => 'required|exists:apps,id',
            'basecamp_id' => 'required|exists:basecamps,id',
            'gardu_induk_id' => 'required|exists:gardu_induks,id',
        ];
    }
}

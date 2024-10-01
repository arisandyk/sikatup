<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
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
            'bay_id' => 'sometimes|integer|exists:bays,id',
            'obd' => 'sometimes|integer',
            'cbd' => 'sometimes|integer',
            'obp' => 'sometimes|integer',
            'cbp' => 'sometimes|integer',
            'obr' => 'sometimes|integer',
            'cbr' => 'sometimes|integer',
            'obl' => 'sometimes|integer',
            'cbl' => 'sometimes|integer',
            'obt' => 'sometimes|integer',
            'und' => 'sometimes|integer',
        ];
    }
}

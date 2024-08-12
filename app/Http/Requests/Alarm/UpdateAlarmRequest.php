<?php

namespace App\Http\Requests\Alarm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlarmRequest extends FormRequest
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
            'date_log' => 'sometimes|date',
            'location_id' => 'sometimes|integer|exists:locations,id',
            'event_id' => 'sometimes|integer|exists:events,id',
            'voice' => 'sometimes|string',
        ];
    }
}

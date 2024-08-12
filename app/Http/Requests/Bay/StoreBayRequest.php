<?php

namespace App\Http\Requests\Bay;

use Illuminate\Foundation\Http\FormRequest;

class StoreBayRequest extends FormRequest
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
            'gi_id' => 'required|integer|exists:gardu_induks,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal_operasi' => 'required|date',
            'tegangan_id' => 'required|integer|exists:tegangans,id',
            'trafo_id' => 'required|integer|exists:trafos,id',
            'nomor_series' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ];
    }
}

<?php

namespace App\Http\Requests\Bay;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gi_id' => 'sometimes|integer|exists:gardu_induks,id',
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:255',
            'tanggal_operasi' => 'sometimes|date',
            'tegangan_id' => 'sometimes|integer|exists:tegangans,id',
            'trafo_id' => 'sometimes|integer|exists:trafos,id',
            'nomor_series' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ];
    }
}

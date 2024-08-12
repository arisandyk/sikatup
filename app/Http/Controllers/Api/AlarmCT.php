<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alarm\StoreAlarmRequest;
use App\Http\Requests\Alarm\UpdateAlarmRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Alarm;
use Illuminate\Http\JsonResponse;

class AlarmCT extends Controller
{
    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Alarm
    {
        return new Alarm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAlarmRequest $request
     * @return JsonResponse
     */
    public function store(StoreAlarmRequest $request): JsonResponse
    {
        try {
            $alarm = $this->model()::create($request->validated());
            return ResponseResource::success('Alarm created successfully', $alarm);
        } catch (\Exception $e) {
            return ResponseResource::error('Failed to create alarm', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAlarmRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAlarmRequest $request, int $id): JsonResponse
    {
        try {
            $alarm = $this->model()::find($id);

            if (!$alarm) {
                return ResponseResource::error('Alarm not found', 404);
            }

            $alarm->update($request->validated());
            return ResponseResource::success('Alarm updated successfully', $alarm);
        } catch (\Exception $e) {
            return ResponseResource::error('Failed to update alarm', 500);
        }
    }
}

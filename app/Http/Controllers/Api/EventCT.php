<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use App\Services\MqttService;

class EventCT extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
        $this->mqttService->subscribe();
    }

    protected function model(): Model
    {
        return new Event();
    }

    public function store(StoreEventRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    public function update(UpdateEventRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}

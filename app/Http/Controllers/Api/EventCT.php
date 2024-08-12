<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use App\Events\SensorStatusUpdated;
use PhpMqtt\Client\MqttClient;

class EventCT extends Controller
{

    protected $mqttClient;

    public function __construct(MqttClient $mqttClient)
    {
        $this->mqttClient = $mqttClient;

        // Subscribe to the topic for sensor data
        $this->mqttClient->subscribe('sensor/data', function (string $topic, string $message) {
            $this->storeSensorData(json_decode($message, true));
        });

        // Run the loop to keep the client listening for messages
        $this->mqttClient->loop(true);
    }

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Event
    {
        return new Event();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $event = $this->model()::create($validatedData);

            // Memicu event broadcasting setelah event dibuat
            event(new SensorStatusUpdated($event));

            return ResponseResource::success('Event created successfully', $event, 201);
        } catch (\Exception $e) {
            return ResponseResource::error('Failed to create event', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateEventRequest $request, int $id): JsonResponse
    {
        try {
            $event = $this->model()::find($id);

            if (!$event) {
                return ResponseResource::error('Event not found', 404);
            }

            $validatedData = $request->validated();
            $event->update($validatedData);

            // Memicu event broadcasting setelah event diperbarui
            event(new SensorStatusUpdated($event));

            return ResponseResource::success('Event updated successfully', $event);
        } catch (\Exception $e) {
            return ResponseResource::error('Failed to update event', 500);
        }
    }

    private function storeSensorData(array $data)
    {
        // Validasi dan simpan data sensor ke dalam model Event
        $event = $this->model()::create($data);

        // Memicu event broadcasting setelah data sensor disimpan
        event(new SensorStatusUpdated($event));
    }
}

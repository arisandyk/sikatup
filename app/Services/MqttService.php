<?php

namespace App\Services;

// use PhpMqtt\Client\MqttClient;
// use App\Models\Event;
// use App\Models\Control;
// use App\Models\Alarm;
// use App\Models\Bay;
// use Illuminate\Support\Facades\Log;
// use App\Events\AlarmTriggered;

class MqttService
{
    // protected $mqttClient;

    // public function __construct(MqttClient $mqttClient)
    // {
    //     $this->mqttClient = $mqttClient;
    // }

    // public function subscribe()
    // {
    //     try {
    //         $this->mqttClient->connect();
    //         Log::info('Connected to MQTT broker');

    //         $this->mqttClient->subscribe('/SIKATUP/GI/Bay/Event', function (string $topic, string $message) {
    //             Log::info('MQTT message received', ['topic' => $topic, 'message' => $message]);
    //             $this->processAndHandleMessage($message);
    //         }, config('mqtt.qos', 0));

    //         $this->mqttClient->loop(true);
    //         Log::info('MQTT loop started');
    //     } catch (\Exception $e) {
    //         Log::error('Failed to connect to MQTT broker or loop failed', ['error' => $e->getMessage()]);
    //     } finally {
    //         $this->mqttClient->disconnect();
    //         Log::info('Disconnected from MQTT broker');
    //     }
    // }

    // protected function processAndHandleMessage(string $message)
    // {
    //     Log::info('Received message from MQTT', ['message' => $message]);
    //     try {
    //         $data = json_decode($message, true);

    //         if (json_last_error() !== JSON_ERROR_NONE) {
    //             throw new \Exception('Invalid JSON data received');
    //         }

    //         if (!isset($data['bay_id']) || !is_int($data['bay_id'])) {
    //             throw new \Exception('Missing or invalid required field: bay_id');
    //         }

    //         $bay = Bay::find($data['bay_id']);
    //         if (!$bay) {
    //             throw new \Exception("Bay with id {$data['bay_id']} not found");
    //         }

    //         $event = Event::where('bay_id', $data['bay_id'])->first();

    //         if ($event) {
    //             if ($this->isNewEvent($event, $data)) {
    //                 $this->updateEvent($event, $data);
    //                 $this->updateControl($data);
    //             }
    //         } else {
    //             $event = Event::create($data);
    //             $this->updateControl($data);
    //         }

    //         $this->createAlarms($event, $data);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to process message', ['error' => $e->getMessage(), 'data' => $message]);
    //     }
    // }

    // protected function isNewEvent(Event $event, array $data)
    // {
    //     $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];

    //     foreach ($fields as $field) {
    //         if (isset($data[$field]) && $data[$field] == 1 && $event->$field == 0) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // protected function updateEvent(Event $event, array $data)
    // {
    //     $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];

    //     foreach ($fields as $field) {
    //         $event->$field = $data[$field] ?? 0;
    //     }

    //     $event->save();
    //     Log::info('Event updated successfully', ['data' => $event->toArray()]);
    // }

    // protected function updateControl(array $data)
    // {
    //     $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];
    //     $control = Control::firstOrNew(['bay_id' => $data['bay_id']]);

    //     $isNewData = false;

    //     foreach ($fields as $field) {
    //         if (isset($data[$field]) && $data[$field] == 1) {
    //             $control->$field++;
    //             $isNewData = true;
    //         }
    //     }

    //     if ($isNewData) {
    //         $control->save();
    //         Log::info('Control updated successfully', ['data' => $control->toArray()]);

    //         $this->playAlarmForEvent($data);
    //     }
    // }

    // protected function createAlarms(Event $event, array $data)
    // {
    //     $eventTypeMappings = [
    //         'obd' => 'Opened by Device',
    //         'cbd' => 'Closed by Device',
    //         'obp' => 'Opened by Protection',
    //         'cbp' => 'Closed by Protection',
    //         'obr' => 'Opened by Remote',
    //         'cbr' => 'Closed by Remote',
    //         'obl' => 'Opened by Local',
    //         'cbl' => 'Closed by Local',
    //         'obt' => 'Opened by Teleporter',
    //         'und' => 'Undefined',
    //     ];

    //     foreach ($eventTypeMappings as $field => $description) {
    //         if (isset($data[$field]) && $data[$field] > 0) {
    //             try {
    //                 $alarm = new Alarm();
    //                 $alarm->date_log = now();
    //                 $alarm->location_id = $event->bays->gardu_induks->locations()->first()->id ?? null;
    //                 $alarm->event_id = $event->id;
    //                 $alarm->event_type = $description;
    //                 $alarm->voice = $this->getAlarmSoundForEvent($description);
    //                 $alarm->save();

    //                 Log::info("Alarm created for event type: {$description}", ['alarm' => $alarm->toArray()]);
    //             } catch (\Exception $e) {
    //                 Log::error("Failed to create alarm for event {$event->id}", [
    //                     'error' => $e->getMessage(),
    //                     'field' => $field,
    //                     'description' => $description
    //                 ]);
    //             }
    //         }
    //     }
    // }

    // protected function playAlarmForEvent(array $data)
    // {
    //     $soundMapping = $this->getAlarmSoundForEvent(array_keys(array_filter($data, fn($value) => $value == 1))[0]);
    
    //     if ($soundMapping) {
    //         Log::info('Playing alarm sound', ['sound' => $soundMapping]);
    
    //         // Dispatch event
    //         event(new AlarmTriggered(['voice' => $soundMapping]));
    //     }
    // }

    // protected function getAlarmSoundForEvent($eventType)
    // {
    //     $soundMapping = [
    //         'Opened by Device' => 'opened_by_device.mp3',
    //         'Closed by Device' => 'closed_by_device.mp3',
    //         'Opened by Protection' => 'opened_by_protection.mp3',
    //         'Closed by Protection' => 'closed_by_protection.mp3',
    //         'Opened by Remote' => 'opened_by_remote.mp3',
    //         'Closed by Remote' => 'closed_by_remote.mp3',
    //         'Opened by Local' => 'opened_by_local.mp3',
    //         'Closed by Local' => 'closed_by_local.mp3',
    //         'Opened by Teleporter' => 'opened_by_teleporter.mp3',
    //         'Undefined' => 'undefined_alarm.mp3',
    //     ];

    //     return $soundMapping[$eventType] ?? 'default_alarm.mp3';
    // }
}

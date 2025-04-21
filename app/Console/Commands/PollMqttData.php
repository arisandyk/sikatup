<?php

namespace App\Console\Commands;

use App\Events\AlarmTriggered;
use App\Models\Alarm;
use App\Models\Bay;
use App\Models\Control;
use App\Models\Event;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PollMqttData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:poll-mqtt-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Executed');
        // Retrieve the last checked time from cache (or set a default value)
        $lastCheckedTime = Cache::get('last_checked_time', now()->subMinutes(5));

        Log::info($lastCheckedTime);

        // Query for records updated after the last checked time
        $updatedRecord = Event::where('updated_at', '>', $lastCheckedTime)
            ->orderBy('updated_at', 'asc')
            ->first();

        Log::info(json_encode($updatedRecord));
        Log::info(isset($updatedRecord) ? "true" : "false");

        if (isset($updatedRecord)) {
            $this->processAndHandleMessage($updatedRecord);

            // Process the updated record here
            // Example: Notify the user, trigger a business logic, etc.

            // Update the last checked time to the most recent `updated_at` value
            Log::info("Test");
        }
    }

    protected function processAndHandleMessage(Event $message)
    {
        try {
            if (!isset($message['bay_id'])) {
                throw new Exception('Missing or invalid required field: bay_id');
            }

            $bay = Bay::find($message['bay_id']);
            if (!$bay) {
                throw new Exception("Bay with id {$message['bay_id']} not found");
            }

            Log::info(json_encode($bay));

            $event = Event::where('bay_id', $message['bay_id'])->first();

            Log::info(json_encode($event));

            if ($event) {
                $this->updateControl($message);
                $this->createAlarms($event);
            }
        } catch (\Exception $e) {
            Log::error("Failed to process message : {$e->getMessage()} and " . json_encode($message['bay_id']));
        }
    }

    protected function isNewEvent(Event $event, array $data)
    {
        $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];

        foreach ($fields as $field) {
            if (isset($data[$field]) && $data[$field] == 1 && $event->$field == 0) {
                return true;
            }
        }
        return false;
    }

    protected function updateEvent(Event $event, array $data)
    {
        $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];

        foreach ($fields as $field) {
            $event->$field = $data[$field] ?? 0;
        }

        $event->save();
    }

    protected function updateControl(Event $data)
    {
        $fields = ['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'];
        $control = Control::firstOrNew(['bay_id' => $data->bay_id]);

        $isNewData = false;

        try {
            foreach ($fields as $field) {
                if (isset($data[$field]) && $data[$field] == 0) {
                    $control->$field++;
                    $isNewData = true;
                }
            }

            if ($isNewData) {
                $control->save();
                Log::info(json_encode($control));
            }
        } catch (Exception $e) {
            Log::error("Failed to process message : {$e->getMessage()} and");
        }
    }

    protected function createAlarms(Event $event)
    {
        $eventTypeMappings = [
            'obd' => 'Opened by Device',
            'cbd' => 'Closed by Device',
            'obp' => 'Opened by Protection',
            'cbp' => 'Closed by Protection',
            'obr' => 'Opened by Remote',
            'cbr' => 'Closed by Remote',
            'obl' => 'Opened by Local',
            'cbl' => 'Closed by Local',
            'obt' => 'Opened by Teleporter',
            'und' => 'Undefined',
        ];

        try {
            $bay = $event->bays;
            if (!$bay) {
                Log::warning("Bay not found for event {$event->id}");
            }

            $garduInduk = $bay->gardu_induks;
            if (!$garduInduk) {
                Log::warning("GarduInduk not found for bay {$bay->id}");
            }

            $location = $garduInduk->locations()->first();
            if (!$location) {
                Log::warning("Location not found for GarduInduk {$garduInduk->id}");
            }

            foreach ($eventTypeMappings as $field => $description) {
                if (isset($event[$field]) && $event[$field] == 0) {
                    $alarm = new Alarm();
                    $alarm->date_log = now();
                    $alarm->location_id = $event->bays->gardu_induks->locations()->first()->id ?? null;
                    $alarm->event_id = $event->id;
                    $alarm->event_type = $description;
                    $alarm->voice = $this->getAlarmSoundForEvent($description);
                    $alarm->save();
                    
                    event(new AlarmTriggered(
                        $alarm,
                        $event->bays->gardu_induks->basecamps->apps->id,
                        $event->bays->name,
                    ));

                    Log::info("Created");
                    Log::info(json_encode($alarm));
                }
                Log::info($event[$field]);
                Log::info((isset($event[$field]) && $event[$field]) == 0 ? "true" : "false");
            }

            $lastCheckedTime = $event->updated_at;
            Cache::put('last_checked_time', $lastCheckedTime);
            // event(new AlarmTriggered($alarm));
        } catch (Exception $e) {
            Log::error("Failed to create alarm for event {$event->id}", [
                'error' => $e->getMessage(),
                'field' => $field,
                'description' => $description,
            ]);
        }
    }

    protected function getAlarmSoundForEvent($eventType)
    {
        $soundMapping = [
            'Opened by Device' => 'opened_by_device.mp3',
            'Closed by Device' => 'closed_by_device.mp3',
            'Opened by Protection' => 'opened_by_protection.mp3',
            'Closed by Protection' => 'closed_by_protection.mp3',
            'Opened by Remote' => 'opened_by_remote.mp3',
            'Closed by Remote' => 'closed_by_remote.mp3',
            'Opened by Local' => 'opened_by_local.mp3',
            'Closed by Local' => 'closed_by_local.mp3',
            'Opened by Teleporter' => 'opened_by_teleporter.mp3',
            'Undefined' => 'undefined_alarm.mp3',
        ];

        return $soundMapping[$eventType] ?? 'default_alarm.mp3';
    }
}

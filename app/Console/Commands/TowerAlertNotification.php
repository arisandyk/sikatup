<?php

namespace App\Console\Commands;

use App\Events\TowerAlertProcessed;
use App\Models\Tower;
use App\Models\TowerAlert;
use App\Services\Fonnte;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\MqttClient;

class TowerAlertNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tower-alert-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $mqttClient;

    const MESSAGE_TITLE = "Monitoring Tower";
    const MESSAGE_FOOTER = "Pesan ini dikirim oleh sistem melalui whatsapp.";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->mqttClient = new MqttClient(config('mqtt.host'), config('mqtt.port'));

            // Subscribe to MQTT messages
            $this->subscribe();

            // The MQTT loop will handle incoming messages, and we can periodically check for unprocessed alerts
            $this->info('MQTT subscription started. Listening for messages...');
        } catch (\Exception $e) {
            Log::error('Error in command execution', ['error' => $e->getMessage()]);
            $this->error('An error occurred while executing the command: ' . $e->getMessage());
            exit;
        }
    }

    public function checkUnprocessedAlert()
    {
        try {
            // Acquire a lock to prevent overlapping execution
            $lock = Cache::lock('check_unprocessed_alert', 10); // Lock for 10 seconds

            if ($lock->get()) {
                $towerAlert = TowerAlert::with('tower.penghantar.apps.unitInduk.direktorat')->latest()->first();
                if (is_null($towerAlert)) {
                    $this->info("No alert found.");
                } else {
                    $this->info("Alert found.");

                    $response = $this->sendNotification($towerAlert);
                    $this->notifyAlert();

                    Log::info($response);
                    $this->info("The command was successful! with {$response['message']['status']}");
                }

                // Release the lock
                $lock->release();
            } else {
                $this->info("Another process is already checking for unprocessed alerts.");
            }
        } catch (\Throwable $e) {
            Log::error('Failed to check unprocessed alert', ['error' => $e->getMessage()]);
        }
    }

    public function subscribe()
    {
        try {
            $this->mqttClient->connect();
            Log::info('Connected to MQTT broker');

            $lastCheckTime = Carbon::now();

            // Start a separate thread or timer for periodic checks
            $this->startPeriodicCheck($lastCheckTime);

            // Subscribe to the MQTT topic
            $this->mqttClient->subscribe('/SIMOTES/0001', function (string $topic, string $message) {
                Log::info('MQTT message received', ['topic' => $topic, 'message' => $message]);
                $this->processAndHandleMessage($message);
            }, config('mqtt.qos', 0));

            $this->mqttClient->loop(true); // Start the MQTT loop
            Log::info('MQTT loop started');
        } catch (\Exception $e) {
            Log::error('Failed to connect to MQTT broker or loop failed', ['error' => $e->getMessage()]);
        } finally {
            $this->mqttClient->disconnect();
            Log::info('Disconnected from MQTT broker');
        }
    }

    protected function startPeriodicCheck(&$lastCheckTime)
    {
        // Run a periodic check in a separate thread or process
        while (true) {
            if (Carbon::now()->diffInSeconds($lastCheckTime) >= 10) {
                $this->checkUnprocessedAlert();
                $lastCheckTime = Carbon::now();
            }

            // Sleep for a short duration to avoid excessive CPU usage
            sleep(1);
        }
    }

    public function processAndHandleMessage($message)
    {
        Log::info('Received message from MQTT', ['message' => $message]);
        try {
            // Acquire a lock to prevent overlapping execution
            $lock = Cache::lock('process_mqtt_message', 10); // Lock for 10 seconds

            if ($lock->get()) {
                $data = json_decode($message, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON data received');
                }

                Log::info('Decoded message from MQTT', ['data' => $data]);

                if ($data == 1) {
                    $this->createAlert();
                } else if ($data != 1 || $data != 0) {
                    $this->mqttClient->disconnect();
                    $this->info("Command stopped.");
                    exit;
                } else {
                    $this->checkUnprocessedAlert();
                }

                // Release the lock
                $lock->release();
            } else {
                $this->info("Another process is already handling an MQTT message.");
            }
        } catch (\Exception $e) {
            Log::error('Failed to process message', ['error' => $e->getMessage(), 'data' => $message]);
        }
    }

    protected function createAlert()
    {
        try {
            $minId = Tower::orderBy('id', 'asc')->first()->id ?? null;
            $maxId = Tower::orderBy('id', 'desc')->first()->id ?? null;

            TowerAlert::create([
                'tower_id' => random_int($minId, $maxId),
                'description' => 'Anomali terdeteksi',
            ]);

            $towerAlert = TowerAlert::with('tower.penghantar.apps.unitInduk.direktorat')->latest()->first(); //Get the correct alert.

            $response = $this->sendNotification($towerAlert);
            $this->notifyAlert();

            Log::info($response);
            $this->info("The command was successful! with {$response['message']['status']}");
        } catch (\Exception $e) {
            Log::error("Failed to create alert", [
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function notifyAlert()
    {
        try {
            $towerAlert = TowerAlert::with('tower')->latest()->first();

            event(new TowerAlertProcessed($towerAlert));
        } catch (\Exception $e) {
            Log::error("Failed to notify alert", [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function sendNotification($data)
    {
        $message = $this->getMessage($data);

        $fonnteService = new Fonnte();

        $response = $fonnteService->sendLocation(
            target: "120363412718052406@g.us",
            data_id: $data->id,
            type: "Tower Alert Notification",
            location: [
                $data->tower->latitude,
                $data->tower->longitude,
            ],
            countryCode: 62,
        );

        $response = $fonnteService->sendTextMessage(
            target: "120363412718052406@g.us",
            message: $message,
            data_id: $data->id,
            type: "Tower Alert Notification",
            countryCode: 62,
        );

        return $response;
    }

    public function getMessage($data): string
    {
        $formattedDate = date('d-m-Y H:i:s', strtotime($data->created_at));

        $message = sprintf(
            "
%s

Terjadi aktivitas Pencurian/gangguan yang terdeteksi pada tower berikut:

Tanggal: %s
Nama Penghantar: %s %s
No Tower: %s
Alamat: %s
Latitude: %s
Longitude %s

APP: %s
Unit Induk: %s
Direktorat: %s

%s
        ",
            self::MESSAGE_TITLE,
            $formattedDate,
            $data->tower->name,
            $data->tower->penghantar->name,
            $data->tower->no,
            $data->tower->alamat,
            $data->tower->latitude,
            $data->tower->longitude,
            $data->tower->penghantar->apps->name,
            $data->tower->penghantar->apps->unitInduk->name,
            $data->tower->penghantar->apps->unitInduk->direktorat->name,
            self::MESSAGE_FOOTER
        );

        return $message;
    }
}

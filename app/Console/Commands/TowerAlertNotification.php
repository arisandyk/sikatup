<?php

namespace App\Console\Commands;

use App\Events\TowerAlertProcessed;
use App\Models\Tower;
use App\Models\TowerAlert;
use App\Services\Fonnte;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
        $this->mqttClient = new MqttClient(config('mqtt.host'), config('mqtt.port'));
        $this->subscribe();
    }

    public function subscribe()
    {
        try {
            $this->mqttClient->connect();
            Log::info('Connected to MQTT broker');

            $this->mqttClient->subscribe('/SIMOTES/0001', function (string $topic, string $message) {
                Log::info('MQTT message received', ['topic' => $topic, 'message' => $message]);
                $this->processAndHandleMessage($message);
            }, config('mqtt.qos', 0));

            $this->mqttClient->loop(true);
            Log::info('MQTT loop started');
        } catch (\Exception $e) {
            Log::error('Failed to connect to MQTT broker or loop failed', ['error' => $e->getMessage()]);
        } finally {
            // $this->mqttClient->disconnect();
            Log::info('Disconnected from MQTT broker');
        }
    }

    protected function processAndHandleMessage($message)
    {
        Log::info('Received message from MQTT', ['message' => $message]);
        try {
            $data = json_decode($message, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON data received');
            }

            Log::info('Decoded message from MQTT', ['data' => $data]);

            if ($data == 1) {
                $this->createAlert();
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

        $response = $fonnteService->sendTextMessage(
            target: "120363412718052406@g.us",
            message: $message,
            data_id: $data->id,
            type: "Tower Alert Notification",
            countryCode: 62
        );

        return $response;
    }

    public function getMessage($data): string
    {
        $formattedDate = date('d-m-Y H:i:s', strtotime($data->created_at));

        $message = sprintf(
            "
%s

Anomali terdeteksi pada tower berikut:

Tanggal: %s
Nama Tower: %s
No Tower: %s
Alamat: %s
Latitude: %s
Longitude %s

Penghantar: %s
APP: %s
Unit Induk: %s
Direktorat: %s

%s
        ",
            self::MESSAGE_TITLE,
            $formattedDate,
            $data->tower->name,
            $data->tower->no,
            $data->tower->alamat,
            $data->tower->latitude,
            $data->tower->longitude,
            $data->tower->penghantar->name,
            $data->tower->penghantar->apps->name,
            $data->tower->penghantar->apps->unitInduk->name,
            $data->tower->penghantar->apps->unitInduk->direktorat->name,
            self::MESSAGE_FOOTER
        );

        return $message;
    }
}

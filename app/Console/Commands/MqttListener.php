<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MqttService;
use Illuminate\Support\Facades\Log;

class MqttListener extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Listen to MQTT messages using MqttService';

    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        parent::__construct();
        $this->mqttService = $mqttService;
    }

    public function handle()
    {
        Log::info('Starting MQTT listener...');

        try {
            $this->mqttService->subscribe();
        } catch (\Exception $e) {
            Log::error('MQTT listener encountered an error', ['error' => $e->getMessage()]);
            $this->error('MQTT listener failed: ' . $e->getMessage());
        }

        Log::info('MQTT listener stopped.');
        
    }
}

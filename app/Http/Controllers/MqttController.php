<?php

namespace App\Http\Controllers;

use PhpMqtt\Client\MqttClient;
use Illuminate\Http\Request;

class MqttController
{
    protected $mqttClient;

    // Constructor Injection
    public function __construct(MqttClient $mqttClient)
    {
        $this->mqttClient = $mqttClient;
    }

    public function publish(Request $request)
    {
        $topic = $request->input('topic');
        $message = $request->input('message');
        $qos = $request->input('qos', 0);
        $retain = $request->input('retain', false);

        // Publish the message to the MQTT broker
        $this->mqttClient->publish($topic, $message, $qos, $retain);

        return response()->json(['status' => 'Message published successfully']);
    }

    public function subscribe(Request $request)
    {
        $topic = $request->input('topic');
        $qos = $request->input('qos', 0);

        // Subscribe to the topic
        $this->mqttClient->subscribe($topic, function (string $topic, string $message) {
            // Handle incoming message
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
        }, $qos);

        // Keep the client running to listen for messages
        $this->mqttClient->loop(true); // Keep running until manually disconnected

        return response()->json(['status' => 'Subscribed to topic successfully']);
    }
}

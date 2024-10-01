<?php

return [
    'host' => env('MQTT_HOST', 'mqtt.rajakon.com'),          // Alamat host broker MQTT
    'port' => env('MQTT_PORT', 1883),                 // Port broker MQTT
    'username' => env('MQTT_USERNAME', null),         // Username (jika diperlukan)
    'password' => env('MQTT_PASSWORD', null),         // Password (jika diperlukan)
    'client_id' => env('MQTT_CLIENT_ID', 'mqtt_client'), // ID Klien unik untuk mengidentifikasi klien ini ke broker
    'keep_alive' => env('MQTT_KEEP_ALIVE', 60),       // Interval keep alive dalam detik
    'clean_session' => env('MQTT_CLEAN_SESSION', true), // Apakah akan memulai sesi baru atau melanjutkan sesi sebelumnya
    'protocol' => env('MQTT_PROTOCOL', 'MQTT_3_1_1'),        // Protokol yang digunakan (tcp atau tls)
    'qos' => env('MQTT_QOS', 0),                      // Quality of Service (QoS)
    'retain' => env('MQTT_RETAIN', false),            // Apakah pesan harus disimpan oleh broker
];

<?php

namespace App\Services;

use App\Models\NotificationTracker;
use App\Models\Sender;
use Exception;

class Fonnte
{
    public $baseUrl;
    public $accountToken;
    public $deviceToken;

    public function __construct()
    {
        $this->baseUrl = env('FONNTE_BASE_URL');
        $this->accountToken = env('FONNTE_ACCOUNT_TOKEN');
        $this->deviceToken = Sender::first()->token ?? null;
    }

    public function setDeviceToken($token)
    {
        $this->deviceToken = $token;
    }

    public function addDevice($data): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/add-device",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$this->accountToken}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getDevices(): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/get-devices",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$this->accountToken}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateDevice($data, $token): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/update-device",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$token}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteDevice($data, $token): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/delete-device",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$token}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getQR($data, $token): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/qr",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$token}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function disconnectDevice($token): array
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/disconnect",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$token}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            return [
                'success' => true,
                'message' => json_decode($response, true)
            ];
        } catch (Exception $e) {
            curl_close($curl);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function sendTextMessage($target, $message, $countryCode = '62', $data_id = null, $type)
    {
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$this->baseUrl}/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$this->deviceToken}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            $myResponse = [
                'success' => true,
                'message' => json_decode($response, true)
            ];

            NotificationTracker::create([
                'sender_id' => Sender::first()->id,
                'data_id' => $data_id,
                'type' => $type,
                'status' => 'Success',
                'request' => json_encode([
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ]),
                'success' => json_encode($myResponse)
            ]);

            return $myResponse;
        } catch (Exception $e) {
            curl_close($curl);

            $myResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            NotificationTracker::create([
                'sender_id' => Sender::first()->id,
                'data_id' => $data_id,
                'type' => is_null($data_id) ? 'Daily Notification' : 'Alert Notification',
                'status' => 'Error',
                'request' => json_encode([
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ]),
                'error' => json_encode($myResponse)
            ]);

            return $myResponse;
        }
    }

    public function sendTemplateMessage($target, $template, $countryCode = '62', $data_id = null, $type = null)
    {
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'type-message' => 'template',
                    'template' => $template,
                    'frequency' => 'once',
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: {$this->deviceToken}"
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            $myResponse = [
                'success' => true,
                'message' => json_decode($response, true)
            ];

            NotificationTracker::create([
                'sender_id' => Sender::first()->id,
                'data_id' => $data_id,
                'type' => $type,
                'status' => 'Success',
                'request' => json_encode([
                    'target' => $target,
                    'type-message' => 'template',
                    'template' => $template,
                    'frequency' => 'once',
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ]),
                'success' => json_encode($myResponse)
            ]);

            return $myResponse;
        } catch (Exception $e) {
            curl_close($curl);

            $myResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            NotificationTracker::create([
                'sender_id' => Sender::first()->id,
                'data_id' => $data_id,
                'type' => is_null($data_id) ? 'Daily Notification' : 'Alert Notification',
                'status' => 'Error',
                'request' => json_encode([
                    'target' => $target,
                    'type-message' => 'template',
                    'template' => $template,
                    'frequency' => 'once',
                    'countryCode' => $countryCode,
                    'delay' => '10-15'
                ]),
                'error' => json_encode($myResponse)
            ]);

            return $myResponse;
        }
    }
}

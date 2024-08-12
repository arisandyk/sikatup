<?php

namespace App\Providers;

use App\Models\{
    Alarm,
    App,
    Basecamp,
    Bay,
    Direktorat,
    Event,
    GarduInduk,
    Location,
    Tegangan,
    Trafo,
    UnitInduk,
    User
};
use App\Observers\GeneralObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MqttClient::class, function ($app) {
            $host = config('mqtt.host');
            $port = config('mqtt.port');
            $clientId = config('mqtt.client_id');
            $username = config('mqtt.username');
            $password = config('mqtt.password');
            $keepAlive = config('mqtt.keep_alive');
            $cleanSession = config('mqtt.clean_session');
            $protocol = config('mqtt.protocol');
    
            $connectionSettings = (new ConnectionSettings)
                ->setUsername($username)
                ->setPassword($password)
                ->setKeepAliveInterval($keepAlive)
                ->setUseTls(true);;
    
            $mqttClient = new MqttClient($host, $port, $clientId, MqttClient::MQTT_3_1_1);
            $mqttClient->connect($connectionSettings, $cleanSession);
    
            return $mqttClient;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $models = [
            User::class,
            Direktorat::class,
            UnitInduk::class,
            App::class,
            Basecamp::class,
            GarduInduk::class,
            Location::class,
            Tegangan::class,
            Trafo::class,
            Bay::class,
            Event::class,
            Alarm::class,
        ];

        foreach ($models as $model) {
            $model::observe(GeneralObserver::class);
        }

        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60); // Allow 60 requests per minute
        });
    }
}

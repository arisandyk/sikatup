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
use App\Services\MqttService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MqttClient::class, function ($app) {
            $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
                ->setUsername(config('mqtt.username'))
                ->setPassword(config('mqtt.password'))
                ->setKeepAliveInterval(config('mqtt.keep_alive'))
                // Hilangkan setCleanSession atau gantikan dengan metode lain
                ->setUseTls(false) // Set to true if your broker uses TLS
                ->setTlsSelfSignedAllowed(true); // Only if self-signed certificates are allowed

            $mqttClient = new \PhpMqtt\Client\MqttClient(
                config('mqtt.host'),
                config('mqtt.port'),
                config('mqtt.client_id') // Set client_id here if the library supports it directly in the constructor
            );

            // Set clean session secara manual dalam parameter connect jika diperlukan
            $mqttClient->connect($connectionSettings, config('mqtt.clean_session'));

            return $mqttClient;
        });

        $this->app->singleton(MqttService::class, function ($app) {
            return new MqttService($app->make(MqttClient::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(MqttService $mqttService): void
    {
        // $mqttService->subscribe();

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
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

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 
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
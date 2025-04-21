<?php

use App\Console\Commands\TowerAlertNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:poll-mqtt-data')
    ->everySecond()
    ->sendOutputTo(storage_path('logs/poll-mqtt-data.log'))
    ->runInBackground();
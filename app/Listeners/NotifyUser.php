<?php

namespace App\Listeners;

use App\Events\AlarmTriggered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyUser
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\AlarmTriggered  $event
     * @return void
     */
    public function handle(AlarmTriggered $event)
    {
        // Logika untuk notifikasi atau penanganan event
        $alarm = $event->alarm;

        // Contoh: Log informasi tentang alarm
        Log::info('Alarm triggered', ['alarm' => $alarm]);

        // Anda juga bisa menambahkan logika notifikasi seperti mengirim email, broadcast ke user, dll.
    }
}

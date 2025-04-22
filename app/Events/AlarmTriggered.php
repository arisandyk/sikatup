<?php

namespace App\Events;

use App\Models\Alarm;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlarmTriggered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $alarm;
    public $appId;
    public $bayName;

    public function __construct($alarm, $appId, $bayName)
    {
        $this->alarm = $alarm;
        $this->appId = $appId;
        $this->bayName = $bayName;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('alert.'.$this->appId),
            new Channel('alert'),
        ];
    }

    public function broadcastAs()
    {
        return 'alert-processed';
    }
}

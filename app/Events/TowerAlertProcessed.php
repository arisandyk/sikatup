<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TowerAlertProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $towerAlert;
    public $appId;
    /**
     * Create a new event instance.
     */
    public function __construct($towerAlert, $appId)
    {
        $this->towerAlert = $towerAlert;
        $this->appId = $appId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
           new PrivateChannel('tower-alert.'.$this->appId),
           new Channel('tower-alert'),
        ];
    }

    public function broadcastAs()
    {
        return 'tower-alert-processed';
    }
}

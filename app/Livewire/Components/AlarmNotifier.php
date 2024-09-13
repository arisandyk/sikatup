<?php

namespace App\Livewire\Components;

use Livewire\Component;

class AlarmNotifier extends Component
{
    public $alarmSound;

    protected $listeners = ['alarmTriggered' => 'playAlarm'];

    public function playAlarm($alarm)
    {
        $this->alarmSound = asset('assets/audio/' . $alarm['voice']);
    }

    public function render()
    {
        return view('livewire.components.alarm-notifier');
    }
}

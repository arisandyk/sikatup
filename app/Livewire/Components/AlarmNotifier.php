<?php

namespace App\Livewire\Components;

use App\Events\AlarmTriggered;
use App\Models\Alarm;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AlarmNotifier extends Component
{
    public $alarm;
    
    public function render()
    {
        return view('livewire.components.alarm-notifier', [
            'alarm' => $this->alarm,
        ]);
    }
}

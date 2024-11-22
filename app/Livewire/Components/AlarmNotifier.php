<?php

namespace App\Livewire\Components;

use App\Models\Alarm;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class AlarmNotifier extends Component
{
    public $alarm;

    #[On('new-alarm')]
    public function handleUpdateData($data)
    {
        $this->alarm = $data;
    }

    // #[On('shut-alarm')]
    // public function shutAlert() {
    //     $alarmModel = new Alarm($this->alarm);
    //     $alarmModel->delete();
    // }
    
    public function render()
    {
        return view('livewire.components.alarm-notifier', [
            'alarm' => $this->alarm,
        ]);
    }
}

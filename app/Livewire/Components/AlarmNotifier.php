<?php

namespace App\Livewire\Components;

use App\Models\Alarm;
use App\Models\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class AlarmNotifier extends Component
{
    public $alarm;

    #[On('new-alarm')]
    public function handleUpdateData($data)
    {
        $this->alarm = Alarm::with('event.bays.trafos', 'locations.gardu_induks.basecamps.apps.unitInduk.direktorat')->find($data);
    }
    
    public function render()
    {   
        $currentAppId = explode(',', Auth::user()->current_workplace)[1] ?? null;
        $appId = App::where('id', $currentAppId)->first();

        return view('livewire.components.alarm-notifier', [
            'alarm' => $this->alarm,
            'appId' => $appId->id
        ]);
    }

    public function shutAlert() {
        $this->dispatch('alarm-deleted');
        $this->alarm->delete();
    }
}

<?php

namespace App\Livewire\Components;

use App\Models\App;
use App\Models\TowerAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TowerAlertNotifier extends Component
{
    public $alarm;

    #[On('new-tower-alarm')]
    public function handleUpdateData($data)
    {
        $this->alarm = TowerAlert::with('tower.penghantar.apps.unitInduk.direktorat')->find($data);
    }

    public function render()
    {   
        $currentAppId = explode(',', Auth::user()->current_workplace)[1] ?? null;
        $appId = App::where('id', $currentAppId)->first();
        
        return view('livewire.components.tower-alert-notifier', [
            'alarm' => $this->alarm,
            'appId' => $appId->id
        ]);
    }

    public function shutAlert() {
        $this->dispatch('tower-alarm-deleted');
        $this->alarm->update([
            'user_id' => Auth::user()->id,
        ]);

        $this->alarm->delete();
    }
}

<?php

namespace App\Livewire\Components;

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
        return view('livewire.components.tower-alert-notifier', [
            'alarm' => $this->alarm,
        ]);
    }

    public function shutAlert() {
        $this->alarm->update([
            'user_id' => Auth::user()->id,
        ]);

        $this->alarm->delete();
        $this->dispatch('tower-alarm-deleted');
    }
}

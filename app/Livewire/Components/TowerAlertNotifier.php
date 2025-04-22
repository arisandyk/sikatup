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

    public function mount()
    {
        $currentAppId = explode(',', Auth::user()->current_workplace)[1] ?? null;
        $appId = App::where('id', $currentAppId)->first();

        if (!$appId && request()->route()->getName() !== 'edit-profile') {
            session()->flash('message', 'Akun belum terkait ke APP. Silahkan pilih APP yang telah tersedia untuk mengaitkan akun Anda.');
            return redirect()->route('edit-profile');
        }
    }

    public function render()
    {   
        $currentAppId = explode(',', Auth::user()->current_workplace)[1] ?? null;
        $appId = App::where('id', $currentAppId)->first();

        $channelString = null;
        if (Auth::user()->hasRole('admin')) {
            $channelString = 'tower-alert';
        } else {
            $channelString = 'private-tower-alert.'.$appId->id;
        }

        return view('livewire.components.tower-alert-notifier', [
            'alarm' => $this->alarm,
            'channelString' => $channelString
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

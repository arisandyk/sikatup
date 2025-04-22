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
            $channelString = 'alert';
        } else {
            $channelString = 'private-alert.' . $appId->id;
        }

        return view('livewire.components.alarm-notifier', [
            'alarm' => $this->alarm,
            'channelString' => $channelString
        ]);
    }

    public function shutAlert()
    {
        $this->dispatch('alarm-deleted');
        $this->alarm->delete();
    }
}

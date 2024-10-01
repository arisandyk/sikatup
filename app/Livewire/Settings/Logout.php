<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $showModal = false;
    protected $listeners = ['triggerLogout' => 'confirmLogout'];

    public function confirmLogout()
    {
        $this->showModal = true;
        // Tambahkan ini untuk debugging
        logger('Modal logout seharusnya muncul sekarang.');
    }

    public function cancelLogout()
    {
        $this->showModal = false;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('sign-in');
    }

    public function mount()
    {
        logger('Logout component is mounted.');
    }


    public function render()
    {
        return view('livewire.settings.logout');
    }
}

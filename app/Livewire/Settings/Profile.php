<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{
    public $title;

    public $activeTab = 'profile';

    
    public function mount()
    {
        $this->title = 'Profile';
    }
    public function render()
    {
        return view('livewire.settings.profile')
        ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

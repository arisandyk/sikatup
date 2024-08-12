<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class Dashboard extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Dashboard';
    }

    public function render()
    {
        return view('livewire.menu.dashboard')
            ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

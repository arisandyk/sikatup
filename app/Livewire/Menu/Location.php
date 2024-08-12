<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class Location extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Location';
    }
    public function render()
    {
        return view('livewire.menu.location')
        ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

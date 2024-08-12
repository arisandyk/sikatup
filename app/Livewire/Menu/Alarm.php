<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class Alarm extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Alarm';
    }
    public function render()
    {
        return view('livewire.menu.alarm')
        ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

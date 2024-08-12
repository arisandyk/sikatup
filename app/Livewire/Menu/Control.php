<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class Control extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Control';
    }
    public function render()
    {
        return view('livewire.menu.control')
        ->layout('components.layouts.app', array('title' => $this->title));
    }
}

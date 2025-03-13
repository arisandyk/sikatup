<?php

namespace App\Livewire\Menu;

use App\Models\TowerAlert as ModelsTowerAlert;
use Livewire\Component;

class TowerAlert extends Component
{
    public $title = "Tower Alert";

    public function render()
    {
        return view('livewire.menu.tower-alert', [
            'towerAlerts' => ModelsTowerAlert::with('tower.penghantar.apps.unitInduk.direktorat', 'user')->withTrashed()->latest()->paginate(10)
        ])->layout('components.layouts.app', [
            'title' => $this->title
        ]);
    }
}

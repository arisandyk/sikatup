<?php

namespace App\Livewire\Menu;

use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;
use App\Models\UnitInduk;
use Livewire\Component;

class Simulator extends Component
{
    public $title;
    public $filterUnitInduk = '';
    public $filterApp = '';
    public $filterBasecamp = '';
    public $filterGarduInduk = '';

    public $availableUnitInduks = [];
    public $availableApp = [];
    public $availableBasecamps = [];
    public $availableGarduInduks = [];

    public $imageCondition = 'assets/img/sld/0 0 0.png';

    public function mount()
    {
        $this->title = 'Simulator';
        $this->availableUnitInduks = UnitInduk::distinct()
            ->pluck('name', 'id');
    }

    public function loadApp() {
        if ($this->filterUnitInduk) {
            $this->availableApp = App::distinct()
            ->where('unit_id', $this->filterUnitInduk)
            ->pluck('name', 'id')
            ->toArray();
        }
    }

    public function loadBasecamp() {
        if ($this->filterApp) {
            $this->availableBasecamps = Basecamp::distinct()
            ->where('app_id', $this->filterApp)
            ->pluck('name', 'id')
            ->toArray();
        }
    }

    public function loadGarduInduk() {
        if ($this->filterBasecamp) {
            $this->availableGarduInduks = GarduInduk::distinct()
            ->where('basecamp_id', $this->filterBasecamp)
            ->pluck('name', 'id')
            ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.menu.simulator')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

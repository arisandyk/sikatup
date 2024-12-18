<?php

namespace App\Livewire\Menu;

use App\Models\App;
use App\Models\Basecamp;
use App\Models\Bay;
use App\Models\Event;
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

    public $isActive = [
        false,
        false,
        false
    ];
    public $imageType = [
        'Penghantar',
        'Trafo',
        'Couple'
    ];
    public $imageCondition = [];

    public $buttons = [];

    public $display = "hidden";
    public $bayId = '';
    public $evenyType = '';

    public function mount()
    {
        $this->title = 'Simulator';
        $this->availableUnitInduks = UnitInduk::distinct()
            ->pluck('name', 'id');

        foreach ($this->imageType as $key => $value) {
            array_push($this->imageCondition, "assets/img/sld/{$value} Off.png");
        }
    }

    public function loadApp()
    {
        if ($this->filterUnitInduk) {
            $this->availableApp = App::distinct()
                ->where('unit_id', $this->filterUnitInduk)
                ->pluck('name', 'id')
                ->toArray();
        }
    }

    public function loadBasecamp()
    {
        if ($this->filterApp) {
            $this->availableBasecamps = Basecamp::distinct()
                ->where('app_id', $this->filterApp)
                ->pluck('name', 'id')
                ->toArray();
        }
    }

    public function loadGarduInduk()
    {
        if ($this->filterBasecamp) {
            $this->availableGarduInduks = GarduInduk::distinct()
                ->where('basecamp_id', $this->filterBasecamp)
                ->pluck('name', 'id')
                ->toArray();
        }
    }

    public function loadButton()
    {
        if ($this->filterGarduInduk) {
            $this->buttons = Bay::where('gi_id', $this->filterGarduInduk)->witH('event')->get();
        }

        $this->loadImage();
    }

    public function showDialog($bay_id, $eventType)
    {
        $this->display = 'flex';
        $this->bayId = $bay_id;
        $this->evenyType = strtolower($eventType);
    }

    public function hideDialog()
    {
        $this->display = 'hidden';
        $this->bayId = '';
        $this->evenyType = '';
    }

    public function makeAlert()
    {
        $event = Event::where('bay_id', $this->bayId)->first();


        if ($event && $event->isFillable($this->evenyType)) {
            $event->update([
                $this->evenyType => $this->isOn($event[$this->evenyType])
            ]);
        }

        $this->loadImage();
        $this->hideDialog();
    }

    public function isOn($data)
    {
        return $data == 1 ? 0 : 1;
    }

    public function loadImage()
    {
        foreach ($this->buttons as $key => $item) {
            $event = Event::where('bay_id', $item->id)->first();
        
            $eventTypes = [
                'obd',
                'cbd',
                'obp',
                'cbp',
                'obr',
                'cbr',
                'obl',
                'cbl',
                'obt',
                'und'
            ];
        
            $images = "assets/img/sld/{$this->imageType[$key]} Off.png"; // Default image
        
            foreach ($eventTypes as $type) {
                if (isset($event[$type]) && $event[$type] == 0) {
                    // $images = "assets/img/sld/{$this->imageType[$key]} On.png";
                    $this->isActive[$key] = true;
                    break; // Stop checking further as we found an 'On' condition
                }
            }
        
            $this->imageCondition[$key] = $images;
        }
    }

    public function render()
    {
        return view('livewire.menu.simulator')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

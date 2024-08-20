<?php

namespace App\Livewire\Menu;

use App\Models\Bay;
use App\Models\User;
use App\Models\Location;
use App\Models\Alarm;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\Event;
use App\Models\GarduInduk;
use App\Models\UnitInduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Control extends Component
{
    public $title = 'Control';

    public $unitInduks;
    public $apps = [];
    public $basecamps = [];
    public $garduInduks = [];
    public $bays = [];
    public $selectedUnitInduk = null;
    public $selectedApp = null;
    public $selectedBasecamp = null;
    public $selectedGarduInduk = null;
    public $breadcrumb = [];

    public $currentView = 'apps'; // Default value, adjust as necessary

    public function mount()
    {
        $this->title = 'Control';
        $this->unitInduks = UnitInduk::all();
    }

    public function updatedSelectedUnitInduk()
    {
        $this->reset(['selectedApp', 'selectedBasecamp', 'selectedGarduInduk', 'apps', 'basecamps', 'garduInduks']);
        $this->breadcrumb = [];
        if ($this->selectedUnitInduk) {
            $this->apps = App::where('unit_id', $this->selectedUnitInduk)->get();
        }
    }


    public function fetchApps()
    {
        // Pastikan data yang difilter hanya diambil jika selectedUnitInduk telah dipilih
        $this->apps = App::with(['basecamps.gardu_induks.bays.events'])
            ->when($this->selectedUnitInduk !== 'Pilih' && $this->selectedUnitInduk != null, function ($query) {
                $query->where('unit_id', $this->selectedUnitInduk);
            })
            ->get();
        dd($this->apps);
    }


    public function selectApp($appId)
    {
        $this->selectedApp = $appId;
        $this->reset(['selectedBasecamp', 'selectedGarduInduk', 'basecamps', 'garduInduks']);
        $this->basecamps = Basecamp::where('app_id', $appId)->get();
        $this->updateBreadcrumb();
    }

    public function selectBasecamp($basecampId)
    {
        $this->selectedBasecamp = $basecampId;
        $this->reset(['selectedGarduInduk', 'garduInduks']);
        $this->garduInduks = GarduInduk::where('basecamp_id', $basecampId)->get();
        $this->updateBreadcrumb();
    }

    public function selectGarduInduk($garduIndukId)
    {
        $this->selectedGarduInduk = $garduIndukId;
        $this->bays = Bay::where('gardu_induk_id', $garduIndukId)->get();
        $this->updateBreadcrumb();
    }

    public function resetSelection()
    {
        $this->selectedApp = null;
        $this->selectedBasecamp = null;
        $this->selectedGarduInduk = null;
        $this->currentView = 'apps';
    }

    private function updateBreadcrumb()
    {
        $this->breadcrumb = [];
        if ($this->selectedUnitInduk) {
            $unitInduk = UnitInduk::find($this->selectedUnitInduk);
            $this->breadcrumb[] = $unitInduk->name;
        }
        if ($this->selectedApp) {
            $app = App::find($this->selectedApp);
            $this->breadcrumb[] = $app->name;
        }
        if ($this->selectedBasecamp) {
            $basecamp = Basecamp::find($this->selectedBasecamp);
            $this->breadcrumb[] = $basecamp->name;
        }
        if ($this->selectedGarduInduk) {
            $garduInduk = GarduInduk::find($this->selectedGarduInduk);
            $this->breadcrumb[] = $garduInduk->name;
        }
    }

    public function render()
    {
        // Fetch the required data from your models
        $totalUsers = User::count();
        $devices = Bay::count();
        $locations = Location::count();
        $alarms = Alarm::count();

        // Example previous day data, you should replace this with real historical data
        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count();
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();
        $previousLocations = Location::whereDate('created_at', $yesterday)->count();
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();

        // Calculate the percentages based on real current and previous values
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($locations, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarms, $previousAlarms);

        return view('livewire.menu.control', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'locations' => $locations,
            'locationsPercentage' => $locationsPercentage,
            'alarms' => $alarms,
            'alarmsPercentage' => $alarmsPercentage,
            'unitInduks' => $this->unitInduks,
            'selectedUnitInduk' => $this->selectedUnitInduk,
            'apps' => $this->apps,
            'breadcrumb' => $this->breadcrumb,
            'currentView' => $this->currentView,
            'selectedApp' => $this->selectedApp,
            'selectedBasecamp' => $this->selectedBasecamp,
            'selectedGarduInduk' => $this->selectedGarduInduk,
        ])->layout('components.layouts.app', array('title' => $this->title));
    }


    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '+100%' : '0%';
        }
        $change = (($current - $previous) / $previous) * 100;
        return number_format($change, 2) . '%';
    }
}

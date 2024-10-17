<?php

namespace App\Livewire\Menu;

use App\Models\Alarm;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\Bay;
use App\Models\GarduInduk;
use App\Models\Location;
use App\Models\UnitInduk;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Devices extends Component
{
    use WithPagination;

    public $title = 'Devices';
    public $unitInduks;
    public $apps = [];
    public $basecamps = [];
    public $bays = [];
    public $garduInduks = [];
    public $selectedUnitInduk = null;
    public $selectedApp = null;
    public $selectedBasecamp = null;
    public $selectedGarduInduk = null;
    public $breadcrumb = [];
    public $currentView = 'apps'; // Default value, adjust as necessary


    public function mount(): void
{
    $this->unitInduks = UnitInduk::with('apps.basecamps.gardu_induks.bays')->get();
    $this->apps = App::with('basecamps.gardu_induks.bays')->get();
    $this->basecamps = Basecamp::with('gardu_induks.bays')->get();
    $this->garduInduks = GarduInduk::with('bays')->get();
    $this->bays = Bay::with('gardu_induks.basecamps.apps.unitInduk')->get();
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

        // Fetch the 4 most recent alarms
        $recentAlarms = Alarm::orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        return view('livewire.menu.devices', [
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
            'recentAlarms' => $recentAlarms,
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

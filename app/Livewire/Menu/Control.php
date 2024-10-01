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
            $this->updateBreadcrumb();  // Update breadcrumb after selection
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
        $this->reset(['selectedBasecamp', 'selectedGarduInduk', 'basecamps', 'garduInduks', 'bays']);
        $this->basecamps = Basecamp::where('app_id', $appId)->with('gardu_induks.bays.events')->get();
        $this->currentView = 'basecamps';
        $this->updateBreadcrumb();
    }

    public function selectBasecamp($basecampId)
    {
        $this->selectedBasecamp = $basecampId;
        $this->reset(['selectedGarduInduk', 'garduInduks', 'bays']);
        $this->garduInduks = GarduInduk::where('basecamp_id', $basecampId)->with('bays.events')->get();
        $this->currentView = 'gardu_induks';
        $this->updateBreadcrumb();
    }

    public function selectGarduInduk($garduIndukId)
    {
        $this->selectedGarduInduk = $garduIndukId;
        $this->bays = Bay::where('gi_id', $garduIndukId)->with('events')->get();
        $this->currentView = 'bays';
        $this->updateBreadcrumb();
    }


    public function resetSelection()
    {
        $this->selectedApp = null;
        $this->selectedBasecamp = null;
        $this->selectedGarduInduk = null;
        $this->currentView = 'apps';
    }

    public function breadcrumbSelect($level)
    {
        switch ($level) {
            case 'unitInduk':
                $this->resetSelection();  // Resets all selections to the unit level
                $this->breadcrumb = array_slice($this->breadcrumb, 0, 1);
                break;

            case 'app':
                $this->selectedBasecamp = null;
                $this->selectedGarduInduk = null;
                $this->bays = [];
                $this->currentView = 'basecamps';
                $this->breadcrumb = array_slice($this->breadcrumb, 0, 2);  // Keep only "Unit Induk" and "App"
                break;

            case 'basecamp':
                $this->selectedGarduInduk = null;
                $this->bays = [];
                $this->currentView = 'gardu_induks';
                $this->breadcrumb = array_slice($this->breadcrumb, 0, 3);  // Keep "Unit Induk", "App", and "Basecamp"
                break;

            case 'garduInduk':
                $this->currentView = 'bays';
                $this->breadcrumb = array_slice($this->breadcrumb, 0, 4);  // Keep everything up to "Gardu Induk"
                break;
        }
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

        // Fetch the 4 most recent alarms
        $recentAlarms = Alarm::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

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

    public function resetEvent($lastestEventId)
    {
        // Find the latest event by ID
        $lastestEvent = Event::find($lastestEventId);

        if ($lastestEvent) {
            // Update the 'reset_by' field with the authenticated user's ID
            $lastestEvent->reset_by = auth()->id(); // Assuming the user is authenticated

            // Reset all relevant fields to 0
            $lastestEvent->obd = 0;
            $lastestEvent->cbd = 0;
            $lastestEvent->obp = 0;
            $lastestEvent->cbp = 0;
            $lastestEvent->obr = 0;
            $lastestEvent->cbr = 0;
            $lastestEvent->obl = 0;
            $lastestEvent->cbl = 0;
            $lastestEvent->obt = 0;
            $lastestEvent->und = 0;

            // Save the changes to the database
            $lastestEvent->save();

            // Optionally, log this reset or perform other operations
            Log::info("Event reset by user: " . auth()->user()->name);
        }

        // Refresh the data
        $this->updatedSelectedUnitInduk();
    }
}

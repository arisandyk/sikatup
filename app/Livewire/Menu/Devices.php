<?php

namespace App\Livewire\Menu;

use App\Models\Alarm;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\Bay;
use App\Models\GarduInduk;
use App\Models\Location;
use App\Models\Tegangan;
use App\Models\Trafo;
use App\Models\UnitInduk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Devices extends Component
{
    use WithPagination;

    public $title = 'Devices';
    public $unitInduks = [];
    public $apps = [];
    public $basecamps = [];
    public $garduInduks = [];
    public $tegangans = [];
    public $trafos = [];
    public $bays = [];

    // State for selections and current view
    public $selectedUnitInduk = null;
    public $selectedApp = null;
    public $selectedBasecamp = null;
    public $selectedGarduInduk = null;

    public $breadcrumb = [];
    public $currentView = 'apps'; // Default view
    public $newBayName = '';
    public $newBayStatus = '';
    public $newBayTanggalOperasi = '';
    public $newBayTeganganId = null;
    public $newBayTrafoId = null;
    public $newBayNomorSeries = '';
    public $newBayKeterangan = '';

    public $isAddModalOpen = false;
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $bayIdBeingEdited = null;
    public $bayIdBeingDeleted = null;


    protected $rules = [
        'newBayName' => 'required|string|max:255',
        'selectedGarduInduk' => 'required|exists:gardu_induks,id',
        'newBayStatus' => 'required|string|max:50',
        'newBayTanggalOperasi' => 'required|date',
        'newBayTeganganId' => 'required|exists:tegangans,id',
        'newBayTrafoId' => 'required|exists:trafos,id',
        'newBayNomorSeries' => 'nullable|string|max:255',
        'newBayKeterangan' => 'nullable|string|max:500',
    ];

    /**
     * Lifecycle hook: Mount
     */
    public function mount(): void
    {
        $this->loadInitialData();
    }

    /**
     * Load initial data
     */
    private function loadInitialData()
    {
        $this->unitInduks = UnitInduk::with('apps.basecamps.gardu_induks.bays')->get();
        $this->apps = App::with('basecamps.gardu_induks.bays')->get();
        $this->basecamps = Basecamp::with('gardu_induks.bays')->get();
        $this->garduInduks = GarduInduk::with('bays')->get();
        $this->bays = Bay::with('gardu_induks.basecamps.apps.unitInduk')->paginate(10);
        $this->unitInduks = UnitInduk::all();
        $this->tegangans = Tegangan::all();
        $this->trafos = Trafo::all();
    }

    /**
     * Render the component
     */
    public function render()
    {
        // Fetch statistical data
        $stats = $this->getStatistics();

        return view('livewire.menu.devices', [
            'stats' => $stats,
            'unitInduks' => $this->unitInduks,
            'breadcrumb' => $this->breadcrumb,
            'currentView' => $this->currentView,
            'selectedApp' => $this->selectedApp,
            'selectedBasecamp' => $this->selectedBasecamp,
            'selectedGarduInduk' => $this->selectedGarduInduk,
            'totalUsers' => $stats['totalUsers'], // Total users
            'totalUsersPercentage' => $stats['percentages']['users'], // Percentage change for users
            'devices' => $stats['devices'], // Total devices
            'devicesPercentage' => $stats['percentages']['devices'],
            'locations' => $stats['locations'],
            'locationsPercentage' => $stats['percentages']['locations'],
            'alarms' => $stats['alarms'],
            'alarmsPercentage' => $stats['percentages']['alarms'],
        ])->layout('components.layouts.app', ['title' => $this->title]);
    }

    /**
     * Get statistics for devices, locations, and alarms
     */
    private function getStatistics()
    {
        $today = Carbon::now();
        $yesterday = Carbon::yesterday();

        $stats = [
            'totalUsers' => User::count(),
            'devices' => Bay::count(),
            'locations' => Location::count(),
            'alarms' => Alarm::withTrashed()->count(),
            'percentages' => [
                'users' => $this->calculatePercentageChange(
                    User::count(),
                    User::whereDate('created_at', $yesterday)->count()
                ),
                'devices' => $this->calculatePercentageChange(
                    Bay::count(),
                    Bay::whereDate('created_at', $yesterday)->count()
                ),
                'locations' => $this->calculatePercentageChange(
                    Location::count(),
                    Location::whereDate('created_at', $yesterday)->count()
                ),
                'alarms' => $this->calculatePercentageChange(
                    Alarm::withTrashed()->count(),
                    Alarm::withTrashed()->whereDate('created_at', $yesterday)->count()
                ),
            ],
        ];

        return $stats;
    }

    /**
     * Calculate percentage change
     */
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '+100%' : '0%';
        }

        $change = (($current - $previous) / $previous) * 100;
        return number_format($change, 2) . '%';
    }


    /**
     * Import from Excel (stub)
     */
    public function importFromExcel()
    {
        session()->flash('success', 'Import functionality is not implemented yet!');
    }

    public function showAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function hideAddModal()
    {
        $this->isAddModalOpen = false;
        $this->resetForm();
    }

    public function updatedSelectedUnitInduk()
    {
        $this->reset(['selectedApp', 'selectedBasecamp', 'selectedGarduInduk', 'apps', 'basecamps', 'garduInduks']);
        if ($this->selectedUnitInduk) {
            $this->apps = App::where('unit_id', $this->selectedUnitInduk)->get();
        }
    }

    public function updatedSelectedApp()
    {
        $this->reset(['selectedBasecamp', 'selectedGarduInduk', 'basecamps', 'garduInduks']);
        if ($this->selectedApp) {
            $this->basecamps = Basecamp::where('app_id', $this->selectedApp)->get();
        }
    }

    public function updatedSelectedBasecamp()
    {
        $this->reset(['selectedGarduInduk', 'garduInduks']);
        if ($this->selectedBasecamp) {
            $this->garduInduks = GarduInduk::where('basecamp_id', $this->selectedBasecamp)->get();
        }
    }

    public function addNewItem()
    {
        $this->validate();

        Bay::create([
            'gi_id' => $this->selectedGarduInduk,
            'name' => $this->newBayName,
            'status' => $this->newBayStatus,
            'tanggal_operasi' => $this->newBayTanggalOperasi,
            'tegangan_id' => $this->newBayTeganganId,
            'trafo_id' => $this->newBayTrafoId,
            'nomor_series' => $this->newBayNomorSeries,
            'keterangan' => $this->newBayKeterangan,
            'created_by' => Auth::user()->name,
        ]);

        $this->hideAddModal();
        session()->flash('success', 'New Bay added successfully!');

        return redirect()->to('/devices');
    }

    private function resetForm()
    {
        $this->reset([
            'newBayName',
            'newBayStatus',
            'newBayTanggalOperasi',
            'newBayTeganganId',
            'newBayTrafoId',
            'newBayNomorSeries',
            'newBayKeterangan',
            'selectedUnitInduk',
            'selectedApp',
            'selectedBasecamp',
            'selectedGarduInduk',
            'apps',
            'basecamps',
            'garduInduks',
            'bayIdBeingEdited',
        ]);
    }

    public function showEditModal($bayId)
    {
        $this->bayIdBeingEdited = $bayId;
        $this->loadBayData();
        $this->isEditModalOpen = true;
    }

    private function loadBayData()
    {
        $bay = Bay::find($this->bayIdBeingEdited);

        if ($bay) {
            $this->selectedUnitInduk = $bay->gardu_induks->basecamps->apps->unitInduk->id ?? null;
            $this->updatedSelectedUnitInduk();

            $this->selectedApp = $bay->gardu_induks->basecamps->apps->id ?? null;
            $this->updatedSelectedApp();

            $this->selectedBasecamp = $bay->gardu_induks->basecamps->id ?? null;
            $this->updatedSelectedBasecamp();

            $this->selectedGarduInduk = $bay->gardu_induks->id ?? null;

            $this->newBayName = $bay->name;
            $this->newBayStatus = $bay->status;
            $this->newBayTanggalOperasi = $bay->tanggal_operasi;
            $this->newBayTeganganId = $bay->tegangan_id;
            $this->newBayTrafoId = $bay->trafo_id;
            $this->newBayNomorSeries = $bay->nomor_series;
            $this->newBayKeterangan = $bay->keterangan;
        }
    }

    public function hideEditModal()
    {
        $this->isEditModalOpen = false;
        $this->resetForm();
    }

    public function updateItem()
    {
        $this->validate();

        $bay = Bay::find($this->bayIdBeingEdited);

        if ($bay) {
            $bay->update([
                'gi_id' => $this->selectedGarduInduk,
                'name' => $this->newBayName,
                'status' => $this->newBayStatus,
                'tanggal_operasi' => $this->newBayTanggalOperasi,
                'tegangan_id' => $this->newBayTeganganId,
                'trafo_id' => $this->newBayTrafoId,
                'nomor_series' => $this->newBayNomorSeries,
                'keterangan' => $this->newBayKeterangan,
                'updated_by' => Auth::user()->name,
            ]);

            $this->hideEditModal();
            session()->flash('success', 'Bay updated successfully!');
        }
        return redirect()->to('/devices');
    }

    public function confirmDelete($bayId)
    {
        $this->bayIdBeingDeleted = $bayId;
        $this->isDeleteModalOpen = true;
    }

    public function hideDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->bayIdBeingDeleted = null;
    }

    public function deleteItem()
    {
        $bay = Bay::find($this->bayIdBeingDeleted);

        if ($bay) {
            $bay->delete();
            session()->flash('success', 'Bay deleted successfully!');
        }

        $this->hideDeleteModal();
        return redirect()->to('/devices');
    }
}

<?php

namespace App\Livewire\Menu;

use App\Exports\AlarmsExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Bay;
use App\Models\User;
use App\Models\Location;
use App\Models\Alarm;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AlarmLog extends Component
{
    use WithPagination;

    public $title;
    public $selectedLocation = '';
    public $selectedDevice = '';
    public $selectedEvent = '';
    public $perPage = 10;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    // List for dropdowns
    public $locationsList = [];
    public $devicesList = [];
    public $eventTypes = [];
    public $showModal = false;

    protected $queryString = ['search', 'perPage'];

    protected $listeners = [
        'updatedSelectedLocation',
        'updatedSelectedDevice',
        'updatedSelectedEvent'
    ];

    public function mount()
    {
        $this->title = 'Alarm';

        // Load all locations, devices, and event types at the start
        $this->locationsList = Location::all();
        $this->devicesList = Bay::all();
        $this->eventTypes = Alarm::select('event_type')->distinct()->get();

        // Initialize filter values
        $this->selectedLocation = request()->input('location') ?? '';
        $this->selectedDevice = request()->input('device') ?? '';
        $this->selectedEvent = request()->input('event') ?? '';
    }

    // Update filter when location changes
    public function updatedSelectedLocation()
    {
        $this->resetPage();
    }

    public function updatedSelectedDevice()
    {
        $this->resetPage();
    }

    public function updatedSelectedEvent()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function getAlarmsProperty()
    {
        return $this->loadAlarms();
    }

    // Load alarms based on filters
    public function loadAlarms()
    {
        $query = Alarm::query()
            ->when($this->selectedLocation, function ($q) {
                $q->whereHas('locations', function ($subq) {
                    $subq->where('id', $this->selectedLocation);
                });
            })
            ->when($this->selectedDevice, function ($q) {
                $q->whereHas('events.bays', function ($subq) {
                    $subq->where('id', $this->selectedDevice);
                });
            })
            ->when($this->selectedEvent, function ($q) {
                $q->where('event_type', $this->selectedEvent);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($subq) {
                    $subq->where('event_type', 'like', '%' . $this->search . '%')
                        ->orWhereHas('locations', function ($locationq) {
                            $locationq->where('address', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('events.bays', function ($bayq) {
                            $bayq->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('date_log', 'desc');

        return $query->paginate($this->perPage);
    }


    public function render()
    {
        // Data needed for stats
        $totalUsers = User::count();
        $devices = Bay::count();
        $locations = Location::count();
        $alarmsCount = Alarm::count();

        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count();
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();
        $previousLocations = Location::whereDate('created_at', $yesterday)->count();
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();

        // Calculating percentage changes
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($locations, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarmsCount, $previousAlarms);

        // Get recent pending users and alarms
        $pendingUsers = User::where('account_status', 'pending')->get();
        $recentPendingUsers = User::where('account_status', 'pending')->orderBy('created_at', 'asc')->take(3)->get();
        $recentAlarms = Alarm::with(['locations', 'events.bays'])->orderBy('created_at', 'desc')->take(4)->get();

        return view('livewire.menu.alarm-log', [
            'alarms' => $this->alarms,
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'locations' => $locations,
            'locationsPercentage' => $locationsPercentage,
            'alarmsCount' => $alarmsCount,
            'alarmsPercentage' => $alarmsPercentage,
            'pendingUsers' => $pendingUsers,
            'recentPendingUsers' => $recentPendingUsers,
            'recentAlarms' => $recentAlarms,
        ])->layout('components.layouts.app', ['title' => $this->title]);
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '+100%' : '0%';
        }
        $change = (($current - $previous) / $previous) * 100;
        return number_format($change, 2) . '%';
    }

    // Modal controls
    public function showModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }


    public function acceptUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['account_status' => 'active', 'work_status' => 'active']);
            session()->flash('message', 'User accepted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function rejectUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User rejected and deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function exportToExcel()
    {
        $alarms = $this->loadAlarms(); // This should return the filtered alarms
        return Excel::download(new AlarmsExport($alarms), 'alarms.xlsx');
    }

    public function exportToPDF()
    {
        $alarms = $this->loadAlarms();

        // Ensure UTF-8 encoding for each alarm's data
        $alarms = $alarms->map(function ($alarm) {
            return [
                'date_log' => mb_convert_encoding($alarm->date_log, 'UTF-8', 'UTF-8'),
                'location' => mb_convert_encoding($alarm->locations->address ?? 'Unknown Location', 'UTF-8', 'UTF-8'),
                'gardu_induk' => mb_convert_encoding($alarm->locations->gardu_induks->name ?? 'Unknown Gardu Induk', 'UTF-8', 'UTF-8'),
                'bay' => mb_convert_encoding($alarm->events->bays->name ?? 'Unknown Device', 'UTF-8', 'UTF-8'),
                'event_type' => mb_convert_encoding($alarm->event_type, 'UTF-8', 'UTF-8'),
            ];
        });

        $pdf = Pdf::loadView('exports.alarms_pdf', ['alarms' => $alarms]);
        return $pdf->download('alarms.pdf');
    }
}

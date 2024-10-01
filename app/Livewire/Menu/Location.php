<?php

namespace App\Livewire\Menu;

use App\Models\Alarm;
use App\Models\Bay;
use App\Models\Location as LocationModel; // Adjust to your Location model
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Location extends Component
{
    use WithPagination;

    public $title;
    public $showModal = false;
    public $perPage = 10;
    public $search = '';

    protected $queryString = ['search', 'perPage'];
    protected $paginationTheme = 'bootstrap'; // Add pagination theme if you're using Bootstrap

    public function mount()
    {
        $this->title = 'Location';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $totalUsers = User::count();
        $devices = Bay::count();
        $locationCount = LocationModel::count(); // Fixed variable name
        $alarms = Alarm::count();

        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count();
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();
        $previousLocations = LocationModel::whereDate('created_at', $yesterday)->count();
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();

        // Calculate the percentages
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($locationCount, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarms, $previousAlarms);

        // Fetch filtered paginated locations
        $locations = LocationModel::with('gardu_induks')
            ->where('address', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        // Fetch pending users and recent alarms
        $pendingUsers = User::where('account_status', 'pending')->get();
        $recentPendingUsers = User::where('account_status', 'pending')
            ->orderBy('created_at', 'asc')
            ->take(3)
            ->get();
        $recentAlarms = Alarm::orderBy('created_at', 'desc')->take(4)->get();

        return view('livewire.menu.location', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'locationCount' => $locationCount, // Renamed for clarity
            'locationsPercentage' => $locationsPercentage,
            'alarms' => $alarms,
            'alarmsPercentage' => $alarmsPercentage,
            'pendingUsers' => $pendingUsers,
            'recentPendingUsers' => $recentPendingUsers,
            'recentAlarms' => $recentAlarms,
            'locations' => $locations, // Pass paginated locations to the view
            'location' => $locations
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

    public function acceptUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->account_status = 'active';
            $user->work_status = 'active';
            $user->save();
            session()->flash('success', 'User accepted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function rejectUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('success', 'User rejected and deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function showModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

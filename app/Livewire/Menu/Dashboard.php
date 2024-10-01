<?php

namespace App\Livewire\Menu;

use App\Models\Alarm;
use App\Models\Bay;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $title;
    public $showModal = false;

    public function mount()
    {
        $this->title = 'Dashboard';
    }

    public function render()
    {
        // Fetch the required data from your models
        $totalUsers = User::count();
        $devices = Bay::count();
        $locations = Location::count();
        $alarms = Alarm::count();

        // Fetch previous day data
        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count();
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();
        $previousLocations = Location::whereDate('created_at', $yesterday)->count();
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();

        // Calculate percentage changes
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($locations, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarms, $previousAlarms);

        // Fetch pending user requests
        $pendingUsers = User::where('account_status', 'pending')->get();

        // Fetch the 3 most recent pending user requests
        $recentPendingUsers = User::where('account_status', 'pending')
            ->orderBy('created_at', 'asc')
            ->take(3)
            ->get();

        $recentAlarms = Alarm::with(['locations', 'events.bays'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();



        return view('livewire.menu.dashboard', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'locations' => $locations,
            'locationsPercentage' => $locationsPercentage,
            'alarms' => $alarms,
            'alarmsPercentage' => $alarmsPercentage,
            'pendingUsers' => $pendingUsers, // Pass all pending users to the view for modal
            'recentPendingUsers' => $recentPendingUsers, // Pass recent pending users to the view for request list
            'recentAlarms' => $recentAlarms,
        ])->layout('components.layouts.app', ['title' => $this->title]);
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

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '+100%' : '0%';
        }
        $change = (($current - $previous) / $previous) * 100;
        return number_format($change, 2) . '%';
    }
}

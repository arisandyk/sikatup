<?php

namespace App\Livewire\Menu;

use App\Models\Alarm;
use App\Models\Bay;
use Livewire\Component;
use App\Models\Location as LocationModel; // Sesuaikan dengan model Location
use App\Models\User;
use Carbon\Carbon;

class Location extends Component
{
    public $title;
    public $locations; // Tambahkan properti locations

    public function mount()
    {
        $this->title = 'Location';
        $this->locations = LocationModel::with('gardu_induks')->get(); // Ambil data dari database
    }

    public function render()
    {
        $totalUsers = User::count();
        $devices = Bay::count();
        $location = \App\Models\Location::count();
        $alarms = Alarm::count();

        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count() ; // Example previous total users count
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();    // Example previous devices count
        $previousLocations = \App\Models\Location::whereDate('created_at', $yesterday)->count();  // Example previous locations count
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();  // Example previous alarms count

        // Calculate the percentages based on real current and previous values
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($location, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarms, $previousAlarms);
        return view('livewire.menu.location', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'location' => $location,
            'locationsPercentage' => $locationsPercentage,
            'alarms' => $alarms,
            'alarmsPercentage' => $alarmsPercentage,])
            ->layout('components.layouts.app', ['title' => $this->title]);
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


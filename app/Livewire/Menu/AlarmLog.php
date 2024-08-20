<?php

namespace App\Livewire\Menu;

use App\Models\Bay;
use App\Models\User;
use App\Models\Location;
use App\Models\Alarm;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Event;

class AlarmLog extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Alarm';
    }

    public function render()
    {
        // Fetch the required data from your models
        $totalUsers = User::count();
        $devices = Bay::count();
        $locations = Location::count();
        $alarm = Alarm::count();

        // You should replace these previous values with real historical data
        $yesterday = Carbon::yesterday();
        $previousTotalUsers = User::whereDate('created_at', $yesterday)->count(); // Example previous total users count
        $previousDevices = Bay::whereDate('created_at', $yesterday)->count();    // Example previous devices count
        $previousLocations = Location::whereDate('created_at', $yesterday)->count();  // Example previous locations count
        $previousAlarms = Alarm::whereDate('created_at', $yesterday)->count();  // Example previous alarms count

        // Calculate the percentages based on real current and previous values
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $previousTotalUsers);
        $devicesPercentage = $this->calculatePercentageChange($devices, $previousDevices);
        $locationsPercentage = $this->calculatePercentageChange($locations, $previousLocations);
        $alarmsPercentage = $this->calculatePercentageChange($alarm, $previousAlarms);

        // Fetch the latest events
        $alarms = Alarm::with('events') // Mengambil relasi 'bays'
            ->latest('updated_at') // Mengambil alarm terbaru
            ->get();

        // Periksa apakah ada alarm untuk menghindari null values
        $latestAlarm = $alarms->first();

        // Pass the data to the view
        return view('livewire.menu.alarm-log', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentage' => $totalUsersPercentage,
            'devices' => $devices,
            'devicesPercentage' => $devicesPercentage,
            'locations' => $locations,
            'locationsPercentage' => $locationsPercentage,
            'alarm' => $alarm,
            'alarms' => $alarms,
            'latestAlarm' => $latestAlarm, // Menyediakan event terbaru
            'alarmsPercentage' => $alarmsPercentage,
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
}

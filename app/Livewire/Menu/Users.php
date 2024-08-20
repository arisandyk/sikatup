<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Carbon\Carbon;

class Users extends Component
{
    use WithPagination;

    public $title;
    public $filterRole = '';
    public $filterPlan = '';
    public $filterStatus = '';
    public $search = '';

    public $editingUser;
    public $name, $email, $role, $account_status;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->title = 'Users';
    }

    public function updating($field)
    {
        $this->resetPage();
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function loadUserForEdit($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->account_status = $user->account_status;

        logger('Editing user: ', ['name' => $this->name, 'email' => $this->email]);
    }

    public function render()
    {
        $query = User::query();

        if ($this->filterRole) {
            $query->where('role', $this->filterRole);
        }

        if ($this->filterPlan) {
            $query->where('plan', $this->filterPlan);
        }

        if ($this->filterStatus) {
            $query->where('account_status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Fetch users for pagination
        $users = $query->paginate(10);

        foreach ($users as $user) {
            $user->unit_name = $this->parseUnitName($user->current_workplace);
            $user->app_name = $this->parseAppName($user->current_workplace);
        }
        // Calculate statistics
        $totalUsers = User::count();
        $activeUsers = User::where('account_status', 'active')->count();
        $inactiveUsers = User::where('account_status', 'inactive')->count();
        $pendingUsers = User::where('account_status', 'pending')->count();

        // Calculate user counts for yesterday
        $yesterday = Carbon::yesterday();
        $totalUsersYesterday = User::whereDate('created_at', $yesterday)->count();
        $activeUsersYesterday = User::where('account_status', 'active')
            ->whereDate('created_at', $yesterday)
            ->count();
        $inactiveUsersYesterday = User::where('account_status', 'inactive')
            ->whereDate('created_at', $yesterday)
            ->count();
        $pendingUsersYesterday = User::where('account_status', 'pending')
            ->whereDate('created_at', $yesterday)
            ->count();

        // Calculate percentage changes
        $totalUsersPercentage = $this->calculatePercentageChange($totalUsers, $totalUsersYesterday);
        $activeUsersPercentage = $this->calculatePercentageChange($activeUsers, $activeUsersYesterday);
        $inactiveUsersPercentage = $this->calculatePercentageChange($inactiveUsers, $inactiveUsersYesterday);
        $pendingUsersPercentage = $this->calculatePercentageChange($pendingUsers, $pendingUsersYesterday);

        return view('livewire.menu.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'pendingUsers',
            'totalUsersPercentage',
            'activeUsersPercentage',
            'inactiveUsersPercentage',
            'pendingUsersPercentage'
        ))->layout('components.layouts.app', ['title' => $this->title]);
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '+100%' : '0%';
        }
        $change = (($current - $previous) / $previous) * 100;
        return number_format($change, 2) . '%';
    }

    private function parseUnitName($currentWorkplace)
    {
        // Extract the Unit name from the concatenated string
        $parts = explode(', ', $currentWorkplace);
        return isset($parts[0]) ? $parts[0] : '';
    }

    private function parseAppName($currentWorkplace)
    {
        // Extract the App name from the concatenated string
        $parts = explode(', ', $currentWorkplace);
        return isset($parts[1]) ? $parts[1] : '';
    }
}

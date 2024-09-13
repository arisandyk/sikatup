<?php

namespace App\Livewire\Menu;

use App\Exports\UsersExport;
use App\Models\UnitInduk;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Users extends Component
{
    use WithPagination;

    public $title;
    public $filterRole = '';
    public $filterUnitInduk = '';
    public $filterStatus = '';
    public $search = '';
    public $perPage = 10;

    public $editingUser;
    public $name, $email, $role, $account_status, $unit_name, $app_name;

    protected $paginationTheme = 'bootstrap';

    public $availableRoles = [];
    public $availableUnits = [];
    public $availableStatuses = ['active', 'inactive', 'pending'];

    protected $listeners = ['userUpdated' => '$refresh'];
    protected $queryString = ['search', 'perPage', 'filterRole', 'filterUnitInduk', 'filterStatus'];
    public $exportFormat = ''; // Tambahkan properti untuk menyimpan pilihan ekspor

    public function mount()
    {
        $this->title = 'Users';
        $this->availableRoles = User::distinct()->pluck('role')->toArray();
        $this->availableUnits = UnitInduk::distinct()->pluck('name')->toArray();
    }

    public function updating($field)
    {
        if ($field !== 'page') {
            $this->resetPage();
        }
    }
    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        // Update user status to inactive before soft deleting
        $user->update(['account_status' => 'inactive', 'work_status' => 'resigned']);


        // Soft delete the user
        $user->delete();

        session()->flash('message', 'User marked as inactive and soft deleted successfully.');
    }

    public function getUsersProperty()
    {
        return $this->loadUsers();
    }

    private function loadUsers()
    {
        $query = User::query();

        if (!empty($this->filterRole)) {
            $query->where('role', $this->filterRole);
        }

        if (!empty($this->filterUnitInduk)) {
            $query->where('current_workplace', 'like', $this->filterUnitInduk . '%');
        }

        if (!empty($this->filterStatus)) {
            $query->where('account_status', $this->filterStatus);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return $query->paginate($this->perPage);
    }


    public function loadUserForEdit($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->account_status = $user->account_status;
        $this->unit_name = $this->parseUnitName($user->current_workplace);
        $this->app_name = $this->parseAppName($user->current_workplace);

        $this->dispatch('showEditModal');
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->editingUser->id,
            'role' => 'required|string',
            'account_status' => 'required|in:active,inactive,pending',
            'unit_name' => 'required|string',
            'app_name' => 'required|string',
        ]);

        $this->editingUser->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'account_status' => $this->account_status,
            'current_workplace' => $this->unit_name . ', ' . $this->app_name,
        ]);

        $this->dispatch('hideEditModal');
        session()->flash('message', 'User updated successfully.');
    }

    public function render()
    {
        $query = User::query();

        if (!empty($this->filterRole)) {
            $query->where('role', $this->filterRole);
        }

        if (!empty($this->filterUnitInduk)) {
            $query->where('current_workplace', 'like', $this->filterUnitInduk . '%');
        }

        if (!empty($this->filterStatus)) {
            $query->where('account_status', $this->filterStatus);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->paginate($this->perPage);

        foreach ($users as $user) {
            $user->unit_name = $this->parseUnitName($user->current_workplace);
            $user->app_name = $this->parseAppName($user->current_workplace);
        }

        $totalUsers = User::count();
        $activeUsers = User::where('account_status', 'active')->count();
        $inactiveUsers = User::where('account_status', 'inactive')->count();
        $pendingUsers = User::where('account_status', 'pending')->count();

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
        return ($change >= 0 ? '+' : '') . number_format($change, 2) . '%';
    }

    private function parseUnitName($currentWorkplace)
    {
        $parts = explode(', ', $currentWorkplace);
        return isset($parts[0]) ? $parts[0] : '';
    }

    private function parseAppName($currentWorkplace)
    {
        $parts = explode(', ', $currentWorkplace);
        return isset($parts[1]) ? $parts[1] : '';
    }

    public function triggerDeleteModal($userId)
    {
        $this->dispatch('confirmDelete', $userId);
    }


    protected function getFilteredUsers()
    {
        // Method to retrieve users based on filters (similar to your render method)
        $query = User::query();

        if (!empty($this->filterRole)) {
            $query->where('role', $this->filterRole);
        }

        if (!empty($this->filterUnitInduk)) {
            $query->where('current_workplace', 'like', $this->filterUnitInduk . '%');
        }

        if (!empty($this->filterStatus)) {
            $query->where('account_status', $this->filterStatus);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }

    public function export($format)
    {
        if ($format == 'exportToCSV') {
            return $this->exportToCSV();
        } elseif ($format == 'exportToExcel') {
            return $this->exportToExcel();
        } elseif ($format == 'exportToPDF') {
            return $this->exportToPDF();
        } elseif ($format == 'print') {
            // You can trigger a print view here
            return $this->dispatch('triggerPrint');
        } elseif ($format == 'copy') {
            // You can handle a copy action here
            return $this->dispatch('triggerCopy');
        }
    }

    public function exportToCSV()
    {
        $filename = 'users_' . now()->format('YmdHis') . '.csv';
        $users = User::all(); // Mendapatkan semua data pengguna
        return Excel::download(new UsersExport($users), $filename, \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportToExcel()
    {
        $filename = 'users_' . now()->format('YmdHis') . '.xlsx';
        $users = User::all(); // Mendapatkan semua data pengguna
        return Excel::download(new UsersExport($users), $filename, \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportToPDF()
    {
        $users = User::all(); // Mendapatkan semua data pengguna
        $pdf = Pdf::loadView('exports.users_pdf', ['users' => $users]);
        return $pdf->download('users_' . now()->format('YmdHis') . '.pdf');
    }
}

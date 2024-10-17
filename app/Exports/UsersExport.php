<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users->map(function ($user) {
            // Pisahkan current_workplace menjadi unit_name dan app_name
            $unitName = $this->parseUnitName($user->current_workplace);
            $appName = $this->parseAppName($user->current_workplace);

            return [
                'name' => $user->name,
                'role' => $user->role,
                'unit_name' => $unitName,
                'app_name' => $appName,
                'status' => $user->account_status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Role',
            'Unit Induk',
            'App',
            'Status',
        ];
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
}

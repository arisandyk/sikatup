<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class Export extends Component
{
    public $exportFormat = 'csv'; // Bind ke wire:model

    public function export()
    {
        $filename = 'users.' . $this->exportFormat;

        switch ($this->exportFormat) {
            case 'csv':
                $this->exportCsv($filename);
                break;

            case 'xlsx':
                $users = $this->getFilteredUsers()->get();
                return Excel::download(new UsersExport($users), $filename);


            case 'pdf':
                return $this->exportPdf($filename);

            case 'print':
                return $this->printData();

            case 'copy':
                return $this->copyData();

            default:
                session()->flash('error', 'Please select a valid export format.');
        }
    }
    protected function exportCsv($filename)
    {
        $users = $this->getFilteredUsers()->get()->toArray();
        $users = $this->convertToUtf8($users);

        $csvContent = collect($users)->map(function ($user) {
            return implode(',', [
                $user['name'],
                $user['role'],
                $this->parseUnitName($user['current_workplace']),
                $this->parseAppName($user['current_workplace']),
                $user['account_status']
            ]);
        })->implode("\n");

        $filePath = 'exports/' . $filename;
        Storage::disk('local')->put($filePath, $csvContent);

        return response()->download(storage_path('app/' . $filePath));
    }




    protected function exportPdf($filename)
    {
        $users = $this->getFilteredUsers()->get()->toArray();
        $users = $this->convertToUtf8($users);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.users-pdf', [
            'users' => collect($users)->map(function ($user) {
                return [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'unit_name' => $this->parseUnitName($user['current_workplace']),
                    'app_name' => $this->parseAppName($user['current_workplace']),
                    'account_status' => $user['account_status']
                ];
            })
        ]);

        return $pdf->download($filename);
    }



    protected function printData()
    {
        // Ambil data pengguna yang difilter atau semua pengguna
        $users = $this->getFilteredUsers()->get();

        // Render view untuk mencetak
        $this->dispatchBrowserEvent('print-data', [
            'content' => view('exports.users_print', ['users' => $users])->render()
        ]);
    }


    protected function convertToUtf8($data)
    {
        if (is_array($data)) {
            return array_map(function ($item) {
                return $this->convertToUtf8($item);
            }, $data);
        } elseif (is_string($data)) {
            return mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        } else {
            return $data;
        }
    }


    protected function copyData()
    {
        $users = User::all()->pluck('name', 'email')->toArray();
        $users = $this->convertToUtf8($users);
        $this->dispatchBrowserEvent('copy-to-clipboard', ['content' => json_encode($users)]);
    }


    public function render()
    {
        return view('livewire.components.export');
    }

    protected function getFilteredUsers()
    {
        $query = User::query();

        // Tambahkan filter sesuai dengan kebutuhan
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

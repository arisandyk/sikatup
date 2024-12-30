<?php

namespace App\Livewire\Menu;

use App\Models\AuditTrail as ModelsAuditTrail;
use Livewire\Component;
use Livewire\WithPagination;

class AuditTrail extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $day = '';
    public $month = '';
    public $year = '';

    public $detail = false;
    public $actionDetails = '';

    public $delete = false;
    public $logIdBeingDeleted = null;

    protected $queryString = ['search', 'perPage'];

    public function render()
    {
        return view('livewire.menu.audit-trail', [
            'logs' => $this->loadLogs()
        ])
        ->layout('components.layouts.app', ['title' => "Log"]);
    }

    public function loadLogs() {
        $query = ModelsAuditTrail::with('user')
            ->when($this->search, function ($q) {
                $q->where(function ($subq) {
                    $subq->where('action_type', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($bayq) {
                            $bayq->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->day, function($q) {
                $q->whereDay('created_at', $this->day);
            })
            ->when($this->month, function($q) {
                $q->whereMonth('created_at', $this->month);
            })
            ->when($this->year, function($q) {
                $q->whereYear('created_at', $this->year);
            });

        return $query->latest()->paginate($this->perPage);
    }

    public function showDetail($action_details)
    {
        $this->detail = true;
        $this->actionDetails = $action_details;
        
    }

    public function hideDetail()
    {
        $this->detail = false;
        $this->actionDetails = '';
        
    }

    public function confirmDelete($id)
    {
        $this->logIdBeingDeleted = $id;
        $this->delete = true;
    }

    public function hideDeleteModal()
    {
        $this->delete = false;
        $this->logIdBeingDeleted = null;
    }

    public function deleteItem()
    {
        $log = ModelsAuditTrail::find($this->logIdBeingDeleted);

        if ($log) {
            $log->delete();
            session()->flash('success', 'Log deleted successfully!');
        }

        $this->hideDeleteModal();
        return redirect()->to('/log');
    }
}

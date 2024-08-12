<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

    public $title;
    public $filterRole = '';
    public $filterPlan = '';
    public $filterStatus = '';
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->title = 'Users';
    }

    public function updating($field)
    {
        $this->resetPage();
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
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->paginate(10);

        return view('livewire.menu.users', compact('users'))
            ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

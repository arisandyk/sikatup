<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\User;

class DeleteUserModal extends Component
{
    public $showModal = false;
    public $userToDelete;

    protected $listeners = ['confirmDelete'];

    public function confirmDelete(User $user)
    {
        $this->userToDelete = $user;
        $this->showModal = true;
    }

    public function deleteUser()
    {
        if ($this->userToDelete) {
            $this->userToDelete->delete();
            $this->dispatch('userDeleted');
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->userToDelete = null;
    }

    public function render()
    {
        return view('livewire.components.delete-user-modal');
    }
}
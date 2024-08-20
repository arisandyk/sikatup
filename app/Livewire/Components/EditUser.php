<?php

namespace App\Livewire\Components;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditUser extends Component
{
    public $editingUser;
    public $name, $email, $role, $account_status;
    public $current_workplace;

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

    public function save()
    {
        // Validate input fields
        $this->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'role' => 'sometimes|string',
            'account_status' => 'somtimes|string',
        ]);

        $user = Auth::user();

        if ($user->name !== $this->name) {
            // Simpan permintaan perubahan nama di tabel requests
            Request::create([
                'user_id' => $user->id,
                'request_type' => 'edit_profile',
                'old_value' => $user->name,
                'new_value' => $this->name,
                'status' => 'pending',
            ]);

            session()->flash('status', 'Your name change request has been submitted and is pending approval.');
        }

        if ($user->current_workplace !== $this->current_workplace) {
            // Simpan permintaan perubahan tempat kerja di tabel requests
            Request::create([
                'user_id' => $user->id,
                'request_type' => 'edit_workplace',
                'old_value' => $user->current_workplace,
                'new_value' => $this->current_workplace,
                'status' => 'pending',
            ]);

            session()->flash('status', 'Your workplace change request has been submitted and is pending approval.');
        }

        // Update user details
        $this->editingUser->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'account_status' => $this->account_status,
        ]);

        // Dispatch a success message or perform any other actions
        session()->flash('message', 'User details updated successfully!');

        // Optionally, close the modal or do other post-save actions
        $this->dispatchBrowserEvent('close-modal', ['modalId' => 'editModal']);
    }

    public function render()
    {
        return view('livewire.components.edit-user');
    }
}

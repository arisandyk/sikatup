<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Livewire\Component;

class VerifyEmail extends Component
{
    public $userId;
    public $hash;
    public $status; // Menyimpan status (success atau error)

    public function mount($id, $hash)
    {
        $this->userId = $id;
        $this->hash = $hash;
    }

    public function verify()
    {
        $user = User::findOrFail($this->userId);

        if (!hash_equals($this->hash, sha1($user->getEmailForVerification()))) {
            $this->status = 'error';
            return;
        }

        if ($user->hasVerifiedEmail()) {
            $this->status = 'success';
            return;
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            $this->status = 'success';
        } else {
            $this->status = 'error';
        }
    }

    public function render()
    {
        $this->verify();
        return view('livewire.auth.verify-email')
            ->layout('components.layouts.app', ['title' => 'Email Verification']);
    }
}

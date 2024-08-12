<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Livewire\Component;

class VerifyEmail extends Component
{
    public $userId;
    public $hash;

    public function mount($userId, $hash)
    {
        $this->userId = $userId;
        $this->hash = $hash;
    }

    public function verify()
    {
        $user = User::findOrFail($this->userId);

        if (!hash_equals($this->hash, sha1($user->getEmailForVerification()))) {
            session()->flash('error', 'Invalid verification link.');
            return;
        }

        if ($user->hasVerifiedEmail()) {
            session()->flash('error', 'Email already verified.');
            return;
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            session()->flash('success', 'Email verified successfully!');
        } else {
            session()->flash('error', 'Failed to verify email.');
        }

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}

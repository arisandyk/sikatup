<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignIn extends Component
{
    public $email;
    public $password;
    public $title;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function signIn()
    {
        // Validate the input
        $this->validate();

        // Authenticate the user
        $user = User::where('email', $this->email)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            session()->flash('error', 'The provided credentials are incorrect.');
            return;
        }

        if ($user->email_verified_at === null) {
            session()->flash('error', 'Please verify your email before logging in.');
            return;
        }

        if ($user->account_status == 'pending') {
            session()->flash('error', 'Your account is not approved yet.');
            return;
        }

        if ($user->work_status === 'resigned') {
            session()->flash('error', 'Your account has been marked as resigned.');
            return;
        }

        // Log in the user
        Auth::login($user, true); // Add the "remember" parameter as true

        // Update the online status of the user
        $user->online_status = 'online';
        $user->save();

        // Redirect to the dashboard
        return redirect()->route('dashboard');
    }


    public function mount()
    {
        $this->title = 'Sign In';
    }
    public function render()
    {
        return view('livewire.auth.sign-in')
            ->layout('components.layouts.app', ['title' => $this->title]);
    }
}

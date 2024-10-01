<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SignUp extends Component
{
    public $name;
    public $email;
    public $password;
    public $mobile_number;
    public $title;



    public function register()
    {
        // Membuat instance dari RegisterRequest
        $request = new RegisterRequest();

        // Validasi data menggunakan instance dari RegisterRequest
        $validatedData = $this->validate($request->rules());

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile_number' => $validatedData['mobile_number'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => null,
        ]);

        if ($user) {
            $user->sendEmailVerificationNotification();
            session()->flash('success', 'Registration successful! Please check your email for verification.');
        } else {
            session()->flash('error', 'Something went wrong during registration.');
        }

        return redirect()->route('sign-in');
    }

    public function mount()
    {
        $this->title = 'Sign Up';
    }

    public function render()
    {
        return view('livewire.auth.sign-up')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

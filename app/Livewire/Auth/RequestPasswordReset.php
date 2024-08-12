<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\RequestPasswordResetRequest;
use App\Models\User;
use App\Notifications\ResetPasswordOtpNotification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RequestPasswordReset extends Component
{
    public $email;
    public $mobile_number;

    public $title;

    public function requestReset()
    {
        // Membuat instance dari RequestPasswordResetRequest
        $request = new RequestPasswordResetRequest();

        // Validasi data menggunakan instance dari RequestPasswordResetRequest
        $validatedData = $this->validate($request->rules());

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            session()->flash('error', 'User not found.');
            return;
        }

        $otp = random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
        );

        $user->notify(new ResetPasswordOtpNotification($otp));

        session()->flash('success', 'Password reset email sent.');
    }


    public function mount()
    {
        $this->title = 'Reset Access Key';
    }
    public function render()
    {
        return view('livewire.auth.request-reset-password')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

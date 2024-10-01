<?php

namespace App\Livewire\Auth;

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
    public $contact_input;
    public $is_email = true; // Default to email
    public $title;

    public function requestReset()
    {
        // Memetakan contact_input ke variabel yang sesuai
        if ($this->is_email) {
            $this->email = $this->contact_input;
            $validatedData = $this->validate([
                'email' => 'required|email',
            ]);
            $user = User::where('email', $validatedData['email'])->first();
        } else {
            $this->mobile_number = $this->contact_input;
            $validatedData = $this->validate([
                'mobile_number' => 'required|regex:/^[\+]?[0-9]{10,15}$/',
            ]);
            $user = User::where('mobile_number', $validatedData['mobile_number'])->first();
        }

        // Cek apakah user ada di database
        if (!$user) {
            session()->flash('error', 'User not found.');
            return;
        }

        // Buat dan simpan OTP
        $otp = random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
        );

        // Kirim OTP melalui email atau SMS (sesuai kebutuhan)
        $user->notify(new ResetPasswordOtpNotification($otp));

        // Simpan email atau mobile number di session flash
        if ($this->is_email) {
            session()->flash('email', $validatedData['email']);
        } else {
            session()->flash('mobile_number', $validatedData['mobile_number']);
        }

        session()->flash('success', 'Password reset ' . ($this->is_email ? 'email' : 'SMS') . ' sent.');

        return redirect()->route('reset-password');
    }

    public function mount()
    {
        $this->title = 'Reset Access Key';
    }

    public function toggleMethod($method)
    {
        $this->is_email = $method === 'email';
        $this->contact_input = ''; // Reset input saat metode diubah
    }

    public function render()
    {
        return view('livewire.auth.request-reset-password')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

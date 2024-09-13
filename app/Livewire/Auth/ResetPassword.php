<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\Component;

class ResetPassword extends Component
{
    public $otp;
    public $new_password;
    public $email;           // Untuk menyimpan email
    public $mobile_number;   // Untuk menyimpan nomor ponsel
    public $title;
    public $message = '';
    public $messageType = '';

    protected $rules = [
        'otp' => 'required|string',
        'new_password' => 'required|string|min:8',
    ];

    public function mount()
    {
        $this->title = 'Create New Access Key';

        // Set email atau mobile_number dari session flash
        $this->email = session('email');
        $this->mobile_number = session('mobile_number');

        // Pastikan email atau mobile_number sudah diisi
        if (is_null($this->email) && is_null($this->mobile_number)) {
            return redirect()->route('request-reset-password')->with('error', 'Email or mobile number is required.');
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'otp' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        $identifier = $this->email ?: $this->mobile_number;

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->first();

        if (!$resetRecord) {
            $this->setMessage('No reset request found for this ' . ($this->email ? 'email' : 'mobile number') . '.', 'error');
            return;
        }

        // Validasi OTP yang di-hash
        if (!Hash::check($this->otp, $resetRecord->token)) {
            $this->setMessage('Invalid OTP.', 'error');
            return;
        }

        if (Carbon::parse($resetRecord->created_at)->addMinutes(5)->isPast()) {
            $this->setMessage('OTP has expired.', 'error');
            return;
        }

        $user = User::where('email', $this->email)->orWhere('mobile_number', $this->mobile_number)->first();

        if (!$user) {
            $this->setMessage('User not found.', 'error');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        return redirect()->route('sign-in')->with('status', 'Password reset successfully.');
    }

    private function setMessage($message, $type)
    {
        $this->message = $message;
        $this->messageType = $type;
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

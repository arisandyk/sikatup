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
    public $contact_input;
    public $is_email = true; // Default to email
    public $title;

    public function requestReset()
    {
        // Validasi berdasarkan pilihan (email atau mobile number)
        if ($this->is_email) {
            $validatedData = $this->validate([
                'contact_input' => 'required|email',
            ]);
            $user = User::where('email', $validatedData['contact_input'])->first();
        } else {
            $validatedData = $this->validate([
                'contact_input' => 'required|regex:/^[\+]?[0-9]{10,15}$/',
            ]);
            $user = User::where('mobile_number', $validatedData['contact_input'])->first();
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

        // Flash message dan redirect
        session()->flash('success', 'Password reset ' . ($this->is_email ? 'email' : 'SMS') . ' sent.');

        return redirect()->route('reset-password');
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

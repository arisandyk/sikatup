<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $otp; // Tambahkan variabel otp jika memang digunakan untuk proses verifikasi
    public $new_password; // Tambahkan variabel new_password sesuai dengan form
    public $title;

    public function resetPassword()
    {
        $request = new ResetPasswordRequest();

        // Validasi data menggunakan instance dari ResetPasswordRequest
        $validatedData = $this->validate($request->rules());

        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $validatedData['token'])
            ->first();

        if (!$passwordReset || !Hash::check($validatedData['token'], $passwordReset->token)) {
            session()->flash('error', 'Invalid token.');
            $this->emit('passwordResetFailed');
            return;
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(5)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $passwordReset->email)->delete();
            session()->flash('error', 'Token has expired.');
            $this->emit('passwordResetFailed');
            return;
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            session()->flash('error', 'User not found.');
            $this->emit('passwordResetFailed');
            return;
        }

        $user->password = Hash::make($validatedData['password']);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $passwordReset->email)->delete();

        session()->flash('success', 'Password reset successfully.');
        $this->emit('passwordResetSuccess'); // Emit event success
    }

    public function mount()
    {
        $this->title = 'Create New Access Key';
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('components.layouts.app', ['title' => $this->title]);
    }
}

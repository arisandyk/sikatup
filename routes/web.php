<?php

use App\Http\Middleware\UserRole;
use App\Livewire\Auth\RequestPasswordReset;
use App\Livewire\Menu\AlarmLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\SignIn;
use App\Livewire\Auth\SignUp;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Menu\Dashboard;
use App\Livewire\Menu\Users;
use App\Livewire\Menu\Control;
use App\Livewire\Menu\Location;
use App\Livewire\Settings\EditProfile;
use App\Livewire\Settings\Profile;

Route::get('/', SignIn::class)->name('sign-in');

Route::get('/sign-up', SignUp::class)->name('sign-up');
// Tambahkan rute untuk menangani verifikasi email secara manual
Route::get('/email/verify/{id}/{hash}', \App\Livewire\Auth\VerifyEmail::class)->name('verification.verify')->middleware(['signed']);
Route::get('/reset-password', ResetPassword::class)->name('reset-password');
Route::get('/resend-otp', ResetPassword::class)->name('resend-otp');
Route::get('/request-reset-password', RequestPasswordReset::class)->name('request-reset-password');

// Authenticated routes with Sanctum middleware
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/control', Control::class)->name('control');
    Route::get('/location', Location::class)->name('location');
    Route::get('/alarm', AlarmLog::class)->name('alarm');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/edit-profile', EditProfile::class)->name('edit-profile');
    Route::get('/logout', function () {
        Auth::guard('web')->logout(); // Log out from the session
        return redirect()->route('sign-in');
    })->name('logout');


    Route::get('/export/excel', [AlarmLog::class, 'exportToExcel'])->name('export.excel');
    Route::get('/export/pdf', [AlarmLog::class, 'exportToPDF'])->name('export.pdf');

    Route::middleware([UserRole::class . ':admin'])->group(function () {
        Route::get('/users', Users::class)->name('users');
    });
});

<?php

use App\Events\AlarmTriggered;
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
use App\Livewire\Menu\Devices;
use App\Livewire\Menu\Location;
use App\Livewire\Menu\Simulator;
use App\Livewire\Settings\EditProfile;
use App\Livewire\Settings\Profile;
use App\Models\Alarm;
use Illuminate\Support\Facades\Artisan;

Route::get('/', SignIn::class)->name('login');

Route::get('/sign-up', SignUp::class)->name('register');
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
    Route::get('/simulator', Simulator::class)->name('simulator');
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
        Route::get('/devices', Devices::class)->name('devices');
    });

    Route::post('/send', function() {
        Artisan::call('app:poll-mqtt-data');

        $alarm = Alarm::withTrashed()->with('event.bays.trafos', 'locations.gardu_induks.basecamps.apps.unitInduk.direktorat')->where('deleted_at', null)->first();
    
        if ($alarm) {
            return response()->json([
                'success' => true,
                'alarm' => $alarm
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No active alarm found'
            ]);
        }
    });

    Route::delete('/alarm/{id}', function($id) {
        try {
            $alarm = Alarm::find($id);
            $alarm->delete();

            return response()->json(['message' => 'Message has been send'], 200);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });
});

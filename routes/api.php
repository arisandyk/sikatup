<?php

use App\Http\Controllers\Api\{
    AlarmCT,
    AppCT,
    AuthCT,
    BasecampCT,
    BayCT,
    DirektoratCT,
    EventCT,
    GarduIndukCT,
    LocationCT,
    ProfileCT,
    TeganganCT,
    TrafoCT,
    UnitIndukCT,
    UserCT
};
use App\Http\Middleware\UserRole;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthCT::class, 'register']);
Route::get('/email/verify/{id}/{hash}', [AuthCT::class, 'verifyEmail'])->name('verification.verify');
Route::post('/login', [AuthCT::class, 'login']);
Route::post('/password-reset/request', [AuthCT::class, 'requestPasswordReset']);
Route::post('/password-reset/reset', [AuthCT::class, 'resetPassword']);

// Protected routes (authenticated with Sanctum)
Route::middleware(['auth:sanctum'])->group(function () {

    $readOnlyResources = [
        'profile' => ProfileCT::class,
        'unit-induks' => UnitIndukCT::class,
        'apps' => AppCT::class,
        'basecamps' => BasecampCT::class,
        'gardu-induks' => GarduIndukCT::class,
        'locations' => LocationCT::class,
        'tegangans' => TeganganCT::class,
        'trafos' => TrafoCT::class,
        'bays' => BayCT::class,
        'events' => EventCT::class,
        'alarms' => AlarmCT::class,
    ];

    foreach ($readOnlyResources as $uri => $controller) {
        Route::apiResource($uri, $controller)->only(['index', 'show']);
    }

    Route::post('/refresh', [AuthCT::class, 'refresh']);
    Route::post('/logout', [AuthCT::class, 'logout']);

    // Admin-only routes
    Route::middleware([UserRole::class . ':admin'])->group(function () {
        $adminResources = [
            'users' => UserCT::class,
            'direktorats' => DirektoratCT::class,
            'unit-induks' => UnitIndukCT::class,
            'apps' => AppCT::class,
            'basecamps' => BasecampCT::class,
            'gardu-induks' => GarduIndukCT::class,
            'locations' => LocationCT::class,
            'trafos' => TrafoCT::class,
            'tegangans' => TeganganCT::class,
            'bays' => BayCT::class,
            'events' => EventCT::class,
            'alarms' => AlarmCT::class,
        ];

        foreach ($adminResources as $uri => $controller) {
            Route::apiResource($uri, $controller)->except(['edit', 'create']);
            Route::patch("$uri/restore/{id}", [$controller, 'restore']);
        }
    });

    // User routes
    Route::middleware([UserRole::class . ':user'])->group(function () {
        Route::post('/workplace', [AuthCT::class, 'saveWorkplace']);
    });
});

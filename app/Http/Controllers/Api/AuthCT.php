<?php

namespace App\Http\Controllers\Api;

use App\Helpers\WorkplaceHelper;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SaveWorkplaceRequest;
use App\Http\Requests\Auth\RequestPasswordResetRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\ResponseResource;
use App\Models\User;
use App\Notifications\ResetPasswordOtpNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class AuthCT
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'email_verified_at' => null
        ]);

        if ($user) {
            $user->sendEmailVerificationNotification();
            return ResponseResource::registrationSuccess();
        } else {
            return ResponseResource::error('Something went wrong during registration.', 500);
        }
    }

    public function verifyEmail($id, $hash): JsonResponse
    {
        $user = User::findOrFail($id);

        if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return ResponseResource::error('Invalid verification link.', 400);
        }

        if ($user->hasVerifiedEmail()) {
            return ResponseResource::error('Email already verified.', 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return ResponseResource::emailVerified();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ResponseResource::error('The provided credentials are incorrect', 401);
        }

        if ($user->email_verified_at === null) {
            return ResponseResource::error('Please verify your email before logging in.', 403);
        }

        if ($user->account_status == 'pending') {
            return ResponseResource::error('Your account is not approved yet.', 403);
        }

        if ($user->work_status === 'resigned') {
            return ResponseResource::error('Your account has been marked as resigned.', 403);
        }

        // Check for any active tokens that have not yet expired
        $activeToken = $user->tokens()->where('expires_at', '>', now())->first();

        if ($activeToken) {
            return ResponseResource::error('You are already logged in. Please logout first.', 403);
        }

        $token = $user->createToken($user->name . 'Auth-Token', ['*'], now()->addHour())->plainTextToken;

        // Update the online status of the user
        $user->online_status = 'online';
        $user->save();

        $expiresAt = now()->addHour();

        return ResponseResource::loginSuccess($token, $expiresAt);
    }


    public function saveWorkplace(SaveWorkplaceRequest $request): JsonResponse
    {
        $user = $request->user();

        if ($user->current_workplace) {
            return ResponseResource::error('Workplace already set', 400);
        }

        WorkplaceHelper::saveWorkplace(
            $user->id,
            $request->unit_induk_id,
            $request->app_id,
            $request->basecamp_id,
            $request->gardu_induk_id
        );

        return response()->json(['message' => 'Workplace information is being processed. Please wait for the approvation email from Admin.'], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
            $user->online_status = 'offline';
            $user->save();

            return ResponseResource::error('Logged out successfully', 200);
        } else {
            return ResponseResource::error('User not found', 404);
        }
    }

    public function refresh(Request $request): JsonResponse
    {
        $user = $request->user();
        $currentToken = $request->bearerToken();

        if (!$currentToken) {
            return ResponseResource::error('Token not provided', 401);
        }

        $tokenModel = $user->tokens()->where('token', hash('sha256', explode('|', $currentToken)[1]))->first();

        if (!$tokenModel) {
            return ResponseResource::error('Token not found', 401);
        }

        if (now()->greaterThan($tokenModel->expires_at)) {
            // Token has expired, create a new one
            $newToken = $user->createToken($user->name . 'Auth-Token', ['*'], now()->addHour())->plainTextToken;
            $expiresAt = now()->addHour();
            return ResponseResource::loginSuccess($newToken, $expiresAt);
        }

        return ResponseResource::error('Token is still valid', 400);
    }

    public function requestPasswordReset(RequestPasswordResetRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return ResponseResource::error('User not found', 404);
        }

        $otp = random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
        );

        $user->notify(new ResetPasswordOtpNotification($otp));

        return ResponseResource::error('Password reset email sent', 200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return ResponseResource::error('Invalid token', 400);
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(5)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $passwordReset->email)->delete();
            return ResponseResource::error('Token has expired', 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return ResponseResource::error('User not found', 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $passwordReset->email)->delete();

        return ResponseResource::passwordResetSuccess();
    }
}

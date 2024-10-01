<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Implementasi ini bisa disesuaikan dengan kebutuhan
        return [
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    /**
     * Method untuk response registrasi berhasil
     */
    public static function registrationSuccess()
    {
        return response()->json([
            'message' => 'Registration successful, please check your email to verify your account.'
        ], 201);
    }

    /**
     * Method untuk response login berhasil
     */
    public static function loginSuccess(string $token, string $expiresAt)
    {
        return response()->json([
            'message' => 'Login Successful',
            'token_type' => 'Bearer',
            'token' => $token,
            'expires_at' => $expiresAt
        ], 200);
    }

    /**
     * Method untuk response verifikasi email berhasil
     */
    public static function emailVerified()
    {
        return response()->json([
            'message' => 'Email verified successfully.'
        ], 200);
    }

    /**
     * Method untuk response gagal
     */
    public static function error($message, $statusCode = 400)
    {
        return response()->json([
            'message' => $message
        ], $statusCode);
    }

    /**
     * Method untuk response berhasil
     */

    public static function success($message, $data, $statusCode = 200)
    {
        return response()->json([
           'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Method untuk response password reset berhasil
     */
    public static function passwordResetSuccess()
    {
        return response()->json([
            'message' => 'Password reset successfully'
        ], 200);
    }
}

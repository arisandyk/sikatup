<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\ResponseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileCT
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return ResponseResource::class([
                'message' => 'Profile fetched successfully',
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'current_workplace' => $user->current_workplace,
                    'image' => $user->image,
                    'role' => $user->role,
                ],
            ]);
        } else {
            return ResponseResource::error('Not Authenticated', 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        if (!$user) {
            return ResponseResource::error('Not Authenticated', 401);
        }

        // Get validated data
        $validatedData = $request->validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/users', $image->hashName());

            // Delete old image if it exists
            if ($user->image) {
                Storage::delete('public/users/' . basename($user->image));
            }

            // Update user with new image
            $validatedData['image'] = $image->hashName();
        }

        $user->update($validatedData);

        return ResponseResource::success('Profile updated successfully', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return ResponseResource::error('Not Authenticated', 401);
        }

        $user->work_status = 'resigned';
        $user->account_status = 'inactive';
        $user->save();

        $user->delete();

        return ResponseResource::success('Account deleted successfully', null);
    }
}

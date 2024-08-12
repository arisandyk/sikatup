<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'mobile_number' => '082217368492',
            'email_verified_at' => now(),
            'account_status' => 'active', // Set status to 'approved'
            'work_status' => 'active', // Set work status to 'active'
            'current_workplace' => 'Unit Induk A, App X, Basecamp Y, Gardu Induk Z', // Example value
            'last_workplace' => 'Unit Induk B, App W, Basecamp Z, Gardu Induk Y', // Example value
            'online_status' => 'offline', // Default status
        ]);

        // Create a regular user
        User::create([
            'name' => 'User 1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'mobile_number' => '08747539944',
            'account_status' => 'pending', // Initially pending
            'work_status' => 'pending', // Initially pending
            'current_workplace' => null, // Null until set
            'last_workplace' => null, // Null until set
            'online_status' => 'offline', // Default status
        ]);

        // Create additional users as needed
        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'mobile_number' => '085452267854',
            'account_status' => 'active',
            'work_status' => 'active',
            'current_workplace' => 'Unit Induk Transmisi Jawa Bagian Tengah, App Karawang, Basecamp Karawang, Gardu Induk Telukjambe Timur',
            'last_workplace' => 'Unit Induk Transmisi Jawa Bagian Tengah, App Karawang, Basecamp Karawang, Gardu Induk Telukjambe Timur',
            'online_status' => 'offline',
        ]);
    }
}

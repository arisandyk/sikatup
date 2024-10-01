<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Basecamp;
use App\Models\Bay;
use App\Models\Direktorat;
use App\Models\Event;
use App\Models\GarduInduk;
use App\Models\Tegangan;
use App\Models\Trafo;
use App\Models\UnitInduk;
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

        //Direktorat
        Direktorat::create([
            'name' => 'Direktorat Pembangkit Listrik',
            'created_by' => 'Admin 1',
        ]);

        //Unit Induk
        UnitInduk::create([
            'name' => 'Unit Induk Transmisi Jawa Bagian Barat',
            'direktorat_id' => 1, // Direktorat Jaringan
            'created_by' => 'Admin 1',
        ]);

        // Additional unit induk as needed
        UnitInduk::create([
            'name' => 'Unit Induk Transmisi Jawa Bagian Tengah',
            'direktorat_id' => 1, // Direktorat Jaringan
            'created_by' => 'Admin 1',
        ]);

        //App
        App::create([
            'name' => 'App Karawang',
            'unit_id' => 1, // Unit Induk Transmisi Jawa Bagian Barat
            'created_by' => 'Admin 1',
        ]);

        // Additional app as needed
        App::create([
            'name' => 'App Bekasi',
            'unit_id' => 1, // Unit Induk Transmisi Jawa Bagian Barat
            'created_by' => 'Admin 1',
        ]);

        // Basecamp
        Basecamp::create([
            'name' => 'Basecamp Telukjambe Timur',
            'app_id' => 1, // App Karawang
            'created_by' => 'Admin 1',
        ]);
        // Additional basecamp as needed
        Basecamp::create([
            'name' => 'Basecamp Telukjambe Barat',
            'app_id' => 1, // App Karawang
            'created_by' => 'Admin 1',
        ]);

        // Additional basecamp as needed
        Basecamp::create([
            'name' => 'Basecamp Bekasi',
            'app_id' => 2, // App Karawang
            'created_by' => 'Admin 1',
        ]);

        // Gardu Induk
        GarduInduk::create([
            'name' => 'Gardu Induk Telukjambe Timur',
            'basecamp_id' => 1, // Basecamp Karawang
            'created_by' => 'Admin 1',
        ]);
        // Additional gardu induk as needed
        GarduInduk::create([
            'name' => 'Gardu Induk Telukjambe Barat',
            'basecamp_id' => 1, // Basecamp Karawang
            'created_by' => 'Admin 1',
        ]);

        // Additional gardu induk as needed
        GarduInduk::create([
            'name' => 'Gardu Induk Cikarang Pusat',
            'basecamp_id' => 2, // Basecamp Bekasi
            'created_by' => 'Admin 1',
        ]);

        // Tegangan
        $tegangan1 = Tegangan::create([
            'name' => 'Tegangan 150 kV',
            'created_by' => 'Admin 1',
        ]);

        $tegangan2 = Tegangan::create([
            'name' => 'Tegangan 70 kV',
            'created_by' => 'Admin 1',
        ]);

        // Trafo
        $trafo1 = Trafo::create([
            'name_plate' => 'Trafo 1',
            'deklarasi' => 'D',
            'available' => true,
            'created_by' => 'Admin 1',
        ]);

        $trafo2 = Trafo::create([
            'name_plate' => 'Trafo 2',
            'deklarasi' => 'D',
            'available' => true,
            'created_by' => 'Admin 1',
        ]);

        // Bay
        $bay1 = Bay::create([
            'gi_id' => 1, // Gardu Induk Telukjambe Timur
            'name' => 'Bay A',
            'status' => 'Operasi',
            'tanggal_operasi' => now(),
            'tegangan_id' => $tegangan1->id,
            'trafo_id' => $trafo1->id,
            'nomor_series' => '123456789',
            'keterangan' => 'Keterangan Bay A',
            'created_by' => 'Admin 1',
        ]);

        $bay2 = Bay::create([
            'gi_id' => 2, // Gardu Induk Telukjambe Barat
            'name' => 'Bay B',
            'status' => 'Operasi',
            'tanggal_operasi' => now(),
            'tegangan_id' => $tegangan2->id,
            'trafo_id' => $trafo2->id,
            'nomor_series' => '987654321',
            'keterangan' => 'Keterangan Bay B',
            'created_by' => 'Admin 1',
        ]);

        $bay3 = Bay::create([
            'gi_id' => 3, // Gardu Induk Cikarang Pusat
            'name' => 'Bay C',
            'status' => 'Operasi',
            'tanggal_operasi' => now(),
            'tegangan_id' => $tegangan1->id,
            'trafo_id' => $trafo1->id,
            'nomor_series' => '192837465',
            'keterangan' => 'Keterangan Bay C',
            'created_by' => 'Admin 1',
        ]);

        // Event
        Event::create([
            'bay_id' => $bay1->id,
            'obd' => 5,
            'cbd' => 3,
            'obp' => 2,
            'cbp' => 4,
            'obr' => 1,
            'cbr' => 1,
            'obl' => 0,
            'cbl' => 0,
            'obt' => 0,
            'und' => 0,
        ]);

        Event::create([
            'bay_id' => $bay2->id,
            'obd' => 6,
            'cbd' => 2,
            'obp' => 3,
            'cbp' => 5,
            'obr' => 1,
            'cbr' => 2,
            'obl' => 0,
            'cbl' => 1,
            'obt' => 0,
            'und' => 1,
        ]);

        Event::create([
            'bay_id' => $bay3->id,
            'obd' => 4,
            'cbd' => 4,
            'obp' => 2,
            'cbp' => 3,
            'obr' => 0,
            'cbr' => 1,
            'obl' => 1,
            'cbl' => 0,
            'obt' => 0,
            'und' => 0,
        ]);
    }
}

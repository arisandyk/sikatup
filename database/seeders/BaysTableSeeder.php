<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Adjust the number of records to seed
        $numberOfRecords = 100;

        // Make sure `gardu_induks`, `tegangans`, and `trafos` tables have data
        $giIds = DB::table('gardu_induks')->pluck('id')->toArray();
        $teganganIds = DB::table('tegangans')->pluck('id')->toArray();
        $trafoIds = DB::table('trafos')->pluck('id')->toArray();

        foreach (range(1, $numberOfRecords) as $index) {
            DB::table('bays')->insert([
                'gi_id' => $faker->randomElement($giIds),
                'name' => $faker->word . ' Bay',
                'status' => $faker->randomElement(['Operasi', 'Tidak Operasi', 'Rusak']),
                'tanggal_operasi' => $faker->date(),
                'tegangan_id' => $faker->randomElement($teganganIds),
                'trafo_id' => $faker->randomElement($trafoIds),
                'nomor_series' => strtoupper($faker->bothify('SER-####-##')),
                'keterangan' => $faker->sentence,
                'created_by' => $faker->name,
                'updated_by' => $faker->boolean(50) ? $faker->name : null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}

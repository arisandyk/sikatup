<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah tipe kolom 'status' menjadi VARCHAR (string)
        DB::statement('ALTER TABLE bays MODIFY status VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan tipe kolom 'status' menjadi ENUM jika di-rollback
        DB::statement('ALTER TABLE bays MODIFY status ENUM("Operasi", "Tidak Operasi", "Rusak") NOT NULL');
    }
};

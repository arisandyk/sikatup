<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('reset_by')->nullable()->after('und'); // Menambahkan kolom reset_by setelah kolom und
            $table->foreign('reset_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null'); // Asumsinya reset_by merefer ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['reset_by']);
            $table->dropColumn('reset_by');
        });
    }
};

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
        Schema::create('controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bay_id');
            $table->foreign('bay_id')->references('id')->on('bays')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('obd')->nullable()->default(0);
            $table->integer('cbd')->nullable()->default(0);
            $table->integer('obp')->nullable()->default(0);
            $table->integer('cbp')->nullable()->default(0);
            $table->integer('obr')->nullable()->default(0);
            $table->integer('cbr')->nullable()->default(0);
            $table->integer('obl')->nullable()->default(0);
            $table->integer('cbl')->nullable()->default(0);
            $table->integer('obt')->nullable()->default(0);
            $table->integer('und')->nullable()->default(0);
            $table->unsignedBigInteger('reset_by');// Menambahkan kolom reset_by setelah kolom und
            $table->foreign('reset_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action'); // Asumsinya reset_by merefer ke tabel users
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_controls');
    }
};

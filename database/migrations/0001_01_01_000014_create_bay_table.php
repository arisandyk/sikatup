<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gi_id');
            $table->foreign('gi_id')->references('id')->on('gardu_induks')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable(false);
            $table->enum('status',['Operasi', 'Tidak Operasi', 'Rusak']);
            $table->date('tanggal_operasi')->nullable(false);
            $table->unsignedBigInteger('tegangan_id');
            $table->foreign('tegangan_id')->references('id')->on('tegangans')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('trafo_id');
            $table->foreign('trafo_id')->references('id')->on('trafos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nomor_series');
            $table->text('keterangan');
            $table->string('created_by')->comment('admin_name')->nullable(false);
            $table->string('updated_by')->comment('admin_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bays');
    }
};

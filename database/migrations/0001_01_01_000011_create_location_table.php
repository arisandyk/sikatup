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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gi_id');
            $table->foreign('gi_id')->references('id')->on('gardu_induks')->onUpdate('cascade')->onDelete('cascade');
            $table->text('address');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('locations');
    }
};

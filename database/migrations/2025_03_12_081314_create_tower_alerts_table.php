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
        Schema::create('tower_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tower_id')->references('id')->on('towers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->index()->nullable();
            $table->string("description");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tower_alerts');
    }
};

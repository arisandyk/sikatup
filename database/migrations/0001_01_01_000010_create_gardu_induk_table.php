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
        Schema::create('gardu_induks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basecamp_id');
            $table->foreign('basecamp_id')->references('id')->on('basecamps')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable(false);
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
        Schema::dropIfExists('gardu_induks');
    }
};
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
        Schema::create('notification_trackers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sender_id')->references('id')->on('senders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('data_id')->index()->nullable();
            $table->string('type');
            $table->string('status');
            $table->longText('request');
            $table->longText('success');
            $table->longText('error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_trackers');
    }
};

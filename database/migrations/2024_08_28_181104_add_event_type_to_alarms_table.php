<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventTypeToAlarmsTable extends Migration
{
    public function up()
    {
        Schema::table('alarms', function (Blueprint $table) {
            $table->string('event_type')->after('event_id')->nullable(); // Add event_type column
        });
    }

    public function down()
    {
        Schema::table('alarms', function (Blueprint $table) {
            $table->dropColumn('event_type');
        });
    }
}


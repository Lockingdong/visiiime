<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVTrackEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_track_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('model_id')->index();
            $table->string('model_name', 10);
            $table->string('event_type', 10);
            $table->string('date', 10)->index();
            $table->string('ip', 100)->index();
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('refer', 200)->nullable();
            $table->string('system', 100)->nullable();
            $table->string('browser', 100)->nullable();
            $table->string('lang', 100)->nullable();
            $table->uuid('parent_id')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_track_events');
    }
}

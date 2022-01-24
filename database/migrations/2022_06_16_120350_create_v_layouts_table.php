<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_layouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('theme_name', 10);
            $table->string('layout_type', 6)->nullable();
            $table->string('layout_bg_name', 10);
            $table->string('layout_display_name', 100)->nullable();
            $table->string('layout_code', 20)->index()->unique();
            $table->string('layout_status', 6);
            $table->string('layout_role', 6);
            $table->json('layout_setting')->nullable();
            $table->integer('layout_order')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
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
        Schema::dropIfExists('v_layouts');
    }
}

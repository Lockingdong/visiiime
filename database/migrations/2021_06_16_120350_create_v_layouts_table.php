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
            $table->uuid('theme_id')->index();
            $table->string('layout_name', 10)->index()->unique();
            $table->string('layout_code', 6)->index()->unique();
            $table->string('layout_status', 6)->index();
            $table->json('layout_setting')->nullable();
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

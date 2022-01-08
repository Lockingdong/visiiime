<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVLayoutCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_layout_customs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('page_id')->index();
            $table->uuid('theme_id')->index();
            $table->json('layout_custom_setting')->nullable();
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
        Schema::dropIfExists('v_layout_customs');
    }
}

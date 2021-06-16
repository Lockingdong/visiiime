<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_themes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('theme_name', 10)->index()->unique();
            $table->string('theme_code', 6)->index()->unique();
            $table->string('theme_status', 6)->index();
            $table->json('theme_setting')->nullable();
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
        Schema::dropIfExists('v_themes');
    }
}

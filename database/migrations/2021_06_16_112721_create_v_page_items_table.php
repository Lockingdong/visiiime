<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVPageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_page_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('page_id')->index();
            $table->string('item_name', 50)->nullable();
            $table->string('item_url', 100)->nullable();
            $table->string('item_desc', 200)->nullable();
            $table->string('item_type', 6)->index();
            $table->string('item_status', 6)->index();
            $table->dateTime('start_at')->index()->nullable();
            $table->dateTime('end_at')->index()->nullable();
            $table->string('thumbnail', 100)->nullable();
            $table->json('item_custom_data')->nullable();
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
        Schema::dropIfExists('v_page_items');
    }
}

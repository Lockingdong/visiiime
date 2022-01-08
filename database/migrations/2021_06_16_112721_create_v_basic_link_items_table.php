<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVBasicLinkItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_basic_link_items', function (Blueprint $table) {
            // backend
            $table->uuid('id')->primary();
            $table->uuid('page_id')->index();
            $table->uuid('user_id')->nullable()->index();
            $table->integer('link_order')->nullable();
            $table->string('link_status', 6)->default('AVAL')->index();
            // frontend
            $table->string('link_name', 50)->nullable();
            $table->string('link', 200)->nullable();
            $table->boolean('valid')->default(false);
            $table->boolean('online')->default(false);
            $table->string('link_type', 8)->index();
            $table->dateTime('start_at')->index()->nullable();
            $table->dateTime('end_at')->index()->nullable();
            $table->string('thumbnail', 100)->nullable();
            $table->string('link_custom_data', 1000)->nullable();
            $table->string('media_open_type', 6)->default('EXT')->index();
            $table->string('media_name', 12)->nullable();
            $table->string('collector', 500)->nullable();
            $table->json('item_custom_data')->nullable();
            $table->string('link_area');
            $table->string('link_img_mode')->nullable();
            $table->string('link_col_mode')->nullable();
            $table->string('link_pwd')->nullable();

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
        Schema::dropIfExists('v_basic_link_items');
    }
}

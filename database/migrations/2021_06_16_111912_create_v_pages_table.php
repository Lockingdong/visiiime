<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('theme_id')->index()->nullable();
            $table->string('layout_code', 10)->index()->nullable();
            $table->string('page_default', 2)->nullable();
            $table->string('page_status', 10)->index();
            $table->string('page_url', 15)->index()->unique();

            $table->string('avatar', 100)->nullable();
            $table->string('user_title', 20)->nullable();
            $table->text('description', 150)->nullable();
            $table->boolean('online')->index()->default(false);

            $table->longtext('social_links', 2000)->nullable();
            $table->longtext('main_content')->nullable();

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
        Schema::dropIfExists('v_pages');
    }
}

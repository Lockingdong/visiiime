<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('v_blog_categories');

        Schema::create('v_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('model_name');
            $table->string('cate_name')->comment('名稱');
            $table->string('cate_status')->index();
            $table->integer('cate_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('v_categories');
    }
}

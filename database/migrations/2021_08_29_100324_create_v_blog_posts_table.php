<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_blog_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('cate_id')->nullable()->index();
            $table->string('post_title')->index()->comment('標題');
            $table->longText('post_content')->comment('內容');
            $table->string('post_banner')->nullable()->comment('Banner');
            $table->integer('post_order')->default(0);
            $table->string('post_status')->index();
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
        Schema::dropIfExists('v_blog_posts');
    }
}

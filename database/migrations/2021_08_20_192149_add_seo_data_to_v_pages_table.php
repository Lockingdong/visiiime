<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoDataToVPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v_pages', function (Blueprint $table) {
            $table->string('ga_id')->nullable();
            $table->string('fb_px')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('v_pages', function (Blueprint $table) {
            $table->dropColumn('ga_id');
            $table->dropColumn('fb_px');
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_desc');
        });
    }
}

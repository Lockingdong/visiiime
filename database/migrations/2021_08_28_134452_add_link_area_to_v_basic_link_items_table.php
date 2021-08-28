<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkAreaToVBasicLinkItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v_basic_link_items', function (Blueprint $table) {
            $table->string('link_area')->after('link_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('v_basic_link_items', function (Blueprint $table) {
            $table->dropColumn(['link_area']);
        });
    }
}

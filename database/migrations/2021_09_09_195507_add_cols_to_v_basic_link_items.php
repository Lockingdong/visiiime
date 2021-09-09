<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToVBasicLinkItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v_basic_link_items', function (Blueprint $table) {
            $table->string('link_img_mode')->nullable()->after('link_type');
            $table->string('link_col_mode')->nullable()->after('link_type');
            $table->string('link_pwd')->nullable()->after('link_type');
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
            $table->dropColumn(['link_img_mode']);
            $table->dropColumn(['link_col_mode']);
            $table->dropColumn(['link_pwd']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sub_name')->index();
            $table->integer('sub_amount');
            $table->integer('sub_ori_amount');
            $table->integer('sub_period');
            $table->string('sub_period_type');
            $table->string('sub_status');
            $table->string('sub_image');
            $table->text('sub_content');
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
        Schema::dropIfExists('v_subscriptions');
    }
}

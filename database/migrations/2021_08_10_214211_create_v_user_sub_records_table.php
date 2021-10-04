<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVUserSubRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_user_sub_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('sub_id')->index();
            $table->string('period_no')->nullable()->index();
            $table->string('mer_order_no')->index();
            $table->string('us_name')->index();
            $table->integer('us_ori_amount');
            $table->integer('us_amount');
            $table->string('us_period_type');
            $table->string('us_period');
            $table->string('us_sub_status')->index();
            $table->string('us_pay_status')->index();
            $table->string('us_card_num')->nullable();
            $table->text('us_content');
            $table->dateTime('us_start_at')->index();
            $table->dateTime('us_end_at')->nullable()->index();
            $table->dateTime('us_next_auth_at')->nullable()->index();
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
        Schema::dropIfExists('v_user_sub_records');
    }
}

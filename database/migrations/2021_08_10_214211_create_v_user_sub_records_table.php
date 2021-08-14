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
            $table->string('usr_name')->index();
            $table->integer('usr_ori_amount');
            $table->integer('usr_amount');
            $table->string('usr_period_type');
            $table->string('usr_period');
            $table->string('usr_status')->index();
            $table->string('usr_card_num')->nullable();
            $table->text('usr_content');
            $table->dateTime('usr_start_at')->index();
            $table->dateTime('usr_end_at')->nullable()->index();
            $table->dateTime('usr_next_auth_at')->nullable()->index();
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

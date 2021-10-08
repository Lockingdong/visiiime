<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVSubAuthDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_sub_auth_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('status')->index();
            $table->string('message')->nullable();
            $table->string('merchant_id')->nullable()->index();
            $table->string('merchant_order_no')->nullable()->index();
            $table->string('order_no')->nullable()->index();
            $table->string('period_type')->nullable();
            $table->integer('auth_times')->nullable();
            $table->string('auth_time')->nullable();
            $table->text('date_array')->nullable();
            $table->string('trade_no')->nullable()->index();
            $table->string('card_no')->nullable()->index();
            $table->integer('period_amt')->nullable();
            $table->string('auth_code')->nullable();
            $table->string('respond_code')->nullable();
            $table->string('escrow_bank')->nullable();
            $table->string('auth_bank')->nullable();
            $table->dateTime('auth_date')->nullable();
            $table->dateTime('next_auth_date')->nullable();
            $table->string('total_times')->nullable();
            $table->string('already_times')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('period_no')->nullable()->index();
            $table->string('extday')->nullable();
            $table->string('new_next_time')->nullable();
            $table->text('raw_data')->nullable();
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
        Schema::dropIfExists('v_sub_auth_data');
    }
}

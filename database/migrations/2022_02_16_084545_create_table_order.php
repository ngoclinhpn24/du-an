<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->integer('user_id');
            $table->integer('shipping_id');
            $table->integer('payment_id');
            $table->float('order_total');
            $table->integer('order_code');
            $table->integer('order_status');
            $table->integer('coupon');
            $table->string('day');
            $table->integer('feeship');
            $table->string('shipper_name');
            $table->integer('shipper_phone');
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
        Schema::dropIfExists('order');
    }
};

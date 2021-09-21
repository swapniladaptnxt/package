<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->integer('rider_id')->nullable();
            $table->integer('seen')->default(0);
            $table->integer('order_type')->default(0);
            $table->string('payment_method');
            $table->integer('payment_status')->default(0);
            $table->integer('coupon_id')->nullable();
            $table->string('total')->default(0);
            $table->string('shipping')->default(0);
            $table->double('commission')->default(0);
            $table->string('discount')->default(0);
            $table->integer('status')->default(2);
            $table->text('data')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

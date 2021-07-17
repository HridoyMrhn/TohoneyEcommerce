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
            $table->integer('billing_id');
            $table->integer('shipping_id')->nullable();
            $table->string('cupon_name')->nullable();
            $table->string('payment_gateway');
            $table->float('subtotal');
            $table->float('discount_amount')->nullable();
            $table->float('total');
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('invoice_id')->unique();
            $table->string('payment_status')->default('Unpaid');
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

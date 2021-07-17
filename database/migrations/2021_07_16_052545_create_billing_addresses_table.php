<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('billing_name');
            $table->string('billing_email');
            $table->string('billing_number');
            $table->integer('billing_city_id');
            $table->integer('billing_country_id');
            $table->integer('billing_postal_code');
            $table->longText('billing_address');
            $table->longText('billing_notes')->nullable();
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
        Schema::dropIfExists('billing_addresses');
    }
}

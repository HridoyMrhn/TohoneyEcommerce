<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->float('price');
            $table->integer('quantity');
            $table->integer('quantity_alert')->nullable();
            $table->string('image')->default('default.png')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('slug');
            $table->unsignedInteger('best_sell')->default(0);
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
        Schema::dropIfExists('products');
    }
}

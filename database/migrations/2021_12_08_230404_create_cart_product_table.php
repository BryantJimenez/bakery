<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();
            $table->text('code');
            $table->integer('qty')->default(1);
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->float('complement_price', 10, 2)->default(0.00)->unsigned();
            $table->float('subtotal', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
}

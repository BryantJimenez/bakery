<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->default(1);
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->float('complement_price', 10, 2)->default(0.00)->unsigned();
            $table->float('subtotal', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}

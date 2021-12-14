<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartComplementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_complement', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->default(1);
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->float('subtotal', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('complement_id')->unsigned()->nullable();
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->bigInteger('cart_product_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('complement_id')->references('id')->on('complements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cart_product_id')->references('id')->on('cart_product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_complement');
    }
}

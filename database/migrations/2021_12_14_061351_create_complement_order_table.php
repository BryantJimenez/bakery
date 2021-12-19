<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complement_order', function (Blueprint $table) {
            $table->integer('qty')->default(1);
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->float('subtotal', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('complement_id')->unsigned()->nullable();
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->bigInteger('order_product_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('complement_id')->references('id')->on('complements')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_product_id')->references('id')->on('order_product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complement_order');
    }
}

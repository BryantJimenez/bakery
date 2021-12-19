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
            $table->float('subtotal', 10, 2)->default(0.00)->unsigned();
            $table->float('delivery', 10, 2)->default(0.00)->unsigned();
            $table->float('total', 10, 2)->default(0.00)->unsigned();
            $table->float('fee', 10, 2)->default(0.00)->unsigned();
            $table->float('balance', 10, 2)->default(0.00)->unsigned();
            $table->enum('type_delivery', [1, 2, 3])->default(1);
            $table->string('phone')->nullable();
            $table->enum('state', [0, 1, 2])->default(2);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->bigInteger('payment_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            #Relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null')->onUpdate('cascade');
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

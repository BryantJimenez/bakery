<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complement_group', function (Blueprint $table) {
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->enum('state', [0, 1, 2, 3])->default(1);
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->bigInteger('complement_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('complement_id')->references('id')->on('complements')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complement_group');
    }
}

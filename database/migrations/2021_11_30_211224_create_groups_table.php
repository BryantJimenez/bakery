<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->json('name')->default('[]');
            $table->string('slug')->unique();
            $table->enum('condition', [0, 1])->default(1);
            $table->integer('min')->default(1);
            $table->integer('max')->default(1);
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('attribute_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            #Relations
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}

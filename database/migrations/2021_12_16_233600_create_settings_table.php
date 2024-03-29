<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json('terms')->default('[]');
            $table->json('privacity')->default('[]');
            $table->string('stripe_public')->nullable();
            $table->string('stripe_secret')->nullable();
            $table->enum('force', [0, 1])->default(0);
            $table->enum('state', [0, 1])->default(0);
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

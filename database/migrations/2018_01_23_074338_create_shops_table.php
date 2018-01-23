<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('horseList')->unsigned();
            $table->integer('itemList')->unsigned();
            $table->integer('infraList')->unsigned();
            $table->integer('ridingStableList')->unsigned();
            $table->integer('horseClubList')->unsigned();
            $table->foreign('horseList')->references('id')->on('horses');
            $table->foreign('itemList')->references('id')->on('items');
            $table->foreign('infraList')->references('id')->on('infrastructures');
            $table->foreign('ridingStableList')->references('id')->on('riding_stables');
            $table->foreign('horseClubList')->references('id')->on('horse_clubs');
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
        Schema::dropIfExists('shops');
    }
}

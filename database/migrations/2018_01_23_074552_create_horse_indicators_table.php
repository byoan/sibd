<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorseIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horse_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHorse')->unsigned();
            $table->integer('idIndicator')->unsigned();
            $table->foreign('idIndicator')->references('id')->on('indicators');
            $table->foreign('idHorse')->references('id')->on('horses');
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
        Schema::dropIfExists('horse_indicators');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idNewspaper')->unsigned();
            $table->integer('idWeather')->unsigned();
            $table->foreign('idNewspaper')->references('id')->on('newspaper');
            $table->foreign('idWeather')->references('id')->on('weathers');
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
        Schema::dropIfExists('weather_lists');
    }
}

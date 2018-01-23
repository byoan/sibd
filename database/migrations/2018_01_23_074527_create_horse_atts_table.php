<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorseAttsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horse_atts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHorse')->unsigned();
            $table->integer('idAtt')->unsigned();
            $table->foreign('idHorse')->references('id')->on('horses');
            $table->foreign('idAtt')->references('id')->on('atts');
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
        Schema::dropIfExists('horse_atts');
    }
}

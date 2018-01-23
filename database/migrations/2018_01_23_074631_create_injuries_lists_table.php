<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInjuriesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injuries_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHorse')->unsigned();
            $table->integer('idInjury')->unsigned();
            $table->foreign('idHorse')->references('id')->on('horses');
            $table->foreign('idInjury')->references('id')->on('injuries');
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
        Schema::dropIfExists('injuries_lists');
    }
}

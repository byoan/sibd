<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHorse')->unsigned();
            $table->integer('idDisease')->unsigned();
            $table->foreign('idHorse')->references('id')->on('horses');
            $table->foreign('idDisease')->references('id')->on('diseases');
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
        Schema::dropIfExists('diseases_lists');
    }
}

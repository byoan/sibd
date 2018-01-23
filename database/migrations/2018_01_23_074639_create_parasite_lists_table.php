<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParasiteListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parasite_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHorse')->unsigned();
            $table->integer('idParasite')->unsigned();
            $table->foreign('idHorse')->references('id')->on('horses');
            $table->foreign('idParasite')->references('id')->on('parasites');
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
        Schema::dropIfExists('parasite_lists');
    }
}

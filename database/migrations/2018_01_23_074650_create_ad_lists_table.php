<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idNewspaper')->unsigned();
            $table->integer('idAd')->unsigned();
            $table->foreign('idNewspaper')->references('id')->on('newspapers');
            $table->foreign('idAd')->references('id')->on('ads');
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
        Schema::dropIfExists('ad_lists');
    }
}

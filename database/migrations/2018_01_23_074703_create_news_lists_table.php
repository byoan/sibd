<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idNewspaper')->unsigned();
            $table->integer('idNews')->unsigned();
            $table->foreign('idNewspaper')->references('id')->on('newspaper');
            $table->foreign('idNews')->references('id')->on('news');
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
        Schema::dropIfExists('news_lists');
    }
}

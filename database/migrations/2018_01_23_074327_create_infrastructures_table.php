<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfrastructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('level');
            $table->string('description');
            $table->string('family');
            $table->float('price', 5, 3);
            $table->string('ressourcesConsumption');
            $table->integer('itemCapacity');
            $table->integer('horseCapacity');
            $table->string('itemList');
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
        Schema::dropIfExists('infrastructures');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('lastName');
            $table->char('sex', 1);
            $table->date('birthDate');
            $table->string('phone');
            $table->string('address');
            $table->string('avatar');
            $table->string('description');
            $table->string('website');
            $table->string('ipAddress');
            $table->date('inscriptionDate');
            $table->date('connectionDate');
            $table->string('role');
            $table->integer('idAccount')->unsigned();
            $table->foreign('idAccount')->references('id')->on('accounts');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

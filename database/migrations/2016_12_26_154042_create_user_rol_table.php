<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolTable extends Migration
{

    public function up()
    {
        Schema::create('user_rol', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('rols');
        });
    }

    public function down()
    {
        Schema::drop('user_rol');
    }
}

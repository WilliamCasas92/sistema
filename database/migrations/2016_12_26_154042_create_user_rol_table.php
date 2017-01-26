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
            $table->integer('user_id');
            $table->integer('rol_id');
        });
    }

    public function down()
    {
        Schema::drop('user_rol');
    }
}

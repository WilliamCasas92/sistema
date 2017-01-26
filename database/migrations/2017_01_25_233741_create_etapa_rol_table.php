<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaRolTable extends Migration
{

    public function up()
    {
        Schema::create('etapa_rol', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('etapa_id'); //->unsigned();
            //$table->foreign('etapa_id')->references('id')->on('etapas');
            $table->integer('rol_id'); //->unsigned();
            //$table->foreign('rol_id')->references('id')->on('rols');
        });
    }

    public function down()
    {
        Schema::dropIfExists('etapa_rol');
    }
}

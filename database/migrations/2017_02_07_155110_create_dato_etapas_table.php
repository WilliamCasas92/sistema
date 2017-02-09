<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatoEtapasTable extends Migration
{

    public function up()
    {
        Schema::create('dato_etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('valor');
            $table->integer('proceso_contractual_id')->unsigned();
            $table->foreign('proceso_contractual_id')->references('id')->on('proceso_contractuals');
            $table->integer('requisitos_id')->unsigned();
            $table->foreign('requisitos_id')->references('id')->on('requisitos');
            $table->timestamps();
            $table->unique(['proceso_contractual_id','requisitos_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dato_etapas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoDatoEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_dato_etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('valor');
            $table->integer('proceso_contractual_id');
            $table->integer('requisitos_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historico_dato_etapas');
    }
}

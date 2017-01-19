<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre');
            $table->boolean('obligatorio');
            $table->integer('etapas_id')->unsigned();
            //$table->foreign('tipo_procesos_id')->references('id')->on('tipo_procesos');
            $table->integer('tipo_requisitos_id')->unsigned();
            //$table->foreign('tipo_procesos_id')->references('id')->on('tipo_procesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisitos');
    }
}

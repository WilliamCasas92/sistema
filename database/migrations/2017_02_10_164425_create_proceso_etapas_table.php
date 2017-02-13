<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proceso_contractual_id')->unsigned();
            $table->foreign('proceso_contractual_id')->references('id')->on('proceso_contractuals');
            $table->integer('etapas_id')->unsigned();
            $table->foreign('etapas_id')->references('id')->on('etapas');
            $table->integer('user_id');
            $table->string('estado');
            $table->timestamps();
            $table->unique(['proceso_contractual_id','etapas_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceso_etapas');
    }
}

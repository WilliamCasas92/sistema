<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoContractualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_contractuals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_proceso');
            $table->double('numero_cdp')->unique();
            $table->string('objeto');
            $table->string('dependencia');
            $table->double('numero_contrato');
            $table->date('fecha_aprobacion');
            $table->string('nombre_supervisor');
            $table->string('email_supervisor');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proceso_contractuals');
    }
}

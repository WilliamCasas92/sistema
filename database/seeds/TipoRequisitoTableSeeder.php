<?php

use Illuminate\Database\Seeder;
use App\TipoRequisito;

class TipoRequisitoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tipo de dato 1: texto
        $tipo_text = new TipoRequisito();
        $tipo_text->nombre='Texto';
        $tipo_text->tipo='string';
        $tipo_text->save();

        //Tipo de dato 2: documento
        $tipo_documento = new TipoRequisito();
        $tipo_documento->nombre='Documento';
        $tipo_documento->tipo='file';
        $tipo_documento->save();

        //Tipo de dato 3: email
        $tipo_email = new TipoRequisito();
        $tipo_email->nombre='Email';
        $tipo_email->tipo='email';
        $tipo_email->save();

        //Tipo de dato 4: fecha
        $tipo_fecha = new TipoRequisito();
        $tipo_fecha->nombre='Fecha';
        $tipo_fecha->tipo='date';
        $tipo_fecha->save();

        //Tipo de dato 5: hora
        $tipo_hora = new TipoRequisito();
        $tipo_hora->nombre='Hora';
        $tipo_hora->tipo='time';
        $tipo_hora->save();

        //Tipo de dato 6: Checkbox
        $tipo_booleano = new TipoRequisito();
        $tipo_booleano->nombre='Casilla de verificación';
        $tipo_booleano->tipo='checkbox';
        $tipo_booleano->save();

        //Tipo de dato 7: double
        $tipo_double = new TipoRequisito();
        $tipo_double->nombre='Número';
        $tipo_double->tipo='number';
        $tipo_double->save();
    }
}

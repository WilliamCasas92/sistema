<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    public function tipo_procesos()
    {
        return $this->belongsTo('App\TipoProceso');
    }

    public function requisitos()
    {
        return $this->hasMany('App\Requisito');
    }
}

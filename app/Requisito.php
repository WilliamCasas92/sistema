<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    public function tipo_requisitos()
    {
        return $this->belongsTo('App\TipoRequisito');
    }

    public function etapas()
    {
        return $this->belongsTo('App\Etapa');
    }

    public function dato_etapas()
    {
        return $this->hasMany('App\DatoEtapa');
    }
}
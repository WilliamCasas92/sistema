<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatoEtapa extends Model
{
    public function requisitos()
    {
        return $this->belongsTo('App\Requisito');
    }

    public function proceso_contractuals()
    {
        return $this->belongsTo('App\ProcesoContractual');
    }

    public function historico_dato_etapas()
    {
        return $this->hasMany('App\HistoricoDatoEtapa');
    }
}

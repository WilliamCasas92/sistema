<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoEtapa extends Model
{
    public function proceso_contractuals()
    {
        return $this->belongsTo('App\ProcesoContractual');
    }

    public function etapas()
    {
        return $this->belongsTo('App\Etapa');
    }

    public function historico_proceso_etapa()
    {
        return $this->hasMany('App\HistoricoProcesoEtapa');
    }

}

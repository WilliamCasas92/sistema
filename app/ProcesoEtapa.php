<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class ProcesoEtapa extends Model
{
    use DatesTranslator;

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

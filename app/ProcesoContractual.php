<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class ProcesoContractual extends Model
{
    use DatesTranslator;

    public function tipo_procesos()
    {
        return $this->belongsTo('App\TipoProceso');
    }

    public function dato_etapas()
    {
        return $this->hasMany('App\DatoEtapa');
    }

    public function proceso_etapas()
    {
        return $this->hasMany('App\ProcesoEtapa');
    }
    public function observacions()
    {
        return $this->hasMany('App\Observacion');
    }
}

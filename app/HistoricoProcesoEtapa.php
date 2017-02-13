<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoProcesoEtapa extends Model
{
    public function proceso_etapa()
    {
        return $this->belongsTo('App\ProcesoEtapa');
    }
}

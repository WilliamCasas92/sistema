<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class HistoricoProcesoEtapa extends Model
{
    use DatesTranslator;

    public function proceso_etapa()
    {
        return $this->belongsTo('App\ProcesoEtapa');
    }
}

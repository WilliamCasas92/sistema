<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class HistoricoDatoEtapa extends Model
{
    use DatesTranslator;

    public function dato_etapas()
    {
        return $this->belongsTo('App\DatoEtapa');
    }
}

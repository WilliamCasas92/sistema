<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoDatoEtapa extends Model
{
    public function dato_etapas()
    {
        return $this->belongsTo('App\DatoEtapa');
    }
}

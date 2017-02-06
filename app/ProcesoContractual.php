<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoContractual extends Model
{
    public function tipo_procesos()
    {
        return $this->belongsTo('App\TipoProceso');
    }
}

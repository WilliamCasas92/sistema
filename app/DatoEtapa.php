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
}

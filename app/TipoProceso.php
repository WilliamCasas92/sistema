<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
    use DatesTranslator;

    public function etapas()
    {
        return $this->hasMany('App\Etapa');
    }

    public function proceso_contractuals()
    {
        return $this->hasMany('App\ProcesoContractual');
    }
}

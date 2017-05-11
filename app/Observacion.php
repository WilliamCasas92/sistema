<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use DatesTranslator;
    public function proceso_contractual()
    {
        return $this->belongsTo('App\ProcesoContractual');
    }

}

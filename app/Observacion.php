<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    public function proceso_contractual()
    {
        return $this->belongsTo('App\ProcesoContractual');
    }

}

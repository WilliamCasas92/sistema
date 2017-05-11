<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class TipoRequisito extends Model
{
    use DatesTranslator;

    public function requisitos()
    {
        return $this->hasMany('App\Requisito');
    }
}

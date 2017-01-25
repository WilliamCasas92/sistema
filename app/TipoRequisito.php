<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoRequisito extends Model
{
    public function requisitos()
    {
        return $this->hasMany('App\Requisito');
    }
}

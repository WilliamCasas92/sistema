<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoRequisito extends Model
{
    public function Requisito()
    {
        return $this->hasMany('App\Requisito');
    }
}

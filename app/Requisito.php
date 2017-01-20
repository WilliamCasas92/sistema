<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    public function etapa()
    {
        return $this->belongsTo('App\Etapa');
    }

    public  function tiporequisito()
    {
        return $this->belongsTo('App\TipoRequisito');
    }
}

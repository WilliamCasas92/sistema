<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
   public function etapas(){
       return $this->hasMany('App\Etapa');
   }
}

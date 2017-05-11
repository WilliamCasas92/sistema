<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use DatesTranslator;

    //Uno o varios ROLES pertenecen a muchos USUARIOS
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_rol', 'rol_id', 'user_id');
    }

    //Uno o varios ROLES pertenecen a muchas ETAPAS
    public function etapas()
    {
        return $this->belongsToMany('App\Etapa', 'etapa_rol', 'rol_id', 'etapa_id');
    }
}

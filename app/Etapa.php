<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    //Una ETAPA perenece a un TIPO DE PROCESO
    public function tipo_procesos()
    {
        return $this->belongsTo('App\TipoProceso');
    }

    //Una ETAPA tiene muchos REQUISITOS
    public function requisitos(){
        return $this->hasMany('App\Requisito');
    }

    //Una ETAPA pertenece a muchos ROLES
    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'etapa_rol', 'etapa_id', 'rol_id');
    }

    public function hasAnyRol($roles)
    {
        if (is_array($roles)){
            foreach ($roles as $rol){
                if ($this->hasRol($rol)){
                    return true;
                }
            }
        }else{
            if ($this->hasRol($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRol($rol)
    {
        if ($this->roles()->where('nombre', $rol)->first()){
            return true;
        }
        return false;
    }
}

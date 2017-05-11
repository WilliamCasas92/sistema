<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, DatesTranslator;

    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'user_rol', 'user_id', 'rol_id');
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

    protected $fillable = [
        'nombre', 'apellidos', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

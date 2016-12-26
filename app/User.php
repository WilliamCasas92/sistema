<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'user_rol', 'user_id', 'rol_id');
    }

    protected $fillable = [
        'nombre', 'apellidos', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function users(){
        return $this->belongsToMany('App\User', 'user_rol', 'rol_id', 'user_id');
    }
}

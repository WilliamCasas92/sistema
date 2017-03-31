<?php

namespace App\Http\Middleware;

use Closure;

class CheckAllUsers
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            if (    (\Auth::user()->hasRol('Administrador'))                        ||
                (\Auth::user()->hasRol('Coordinador'))                          ||
                (\Auth::user()->hasRol('Secretario técnico de dependencia'))    ||
                (\Auth::user()->hasRol('Secretario'))                           ||
                (\Auth::user()->hasRol('Abogado'))                              ||
                (\Auth::user()->hasRol('Gestor de contratación'))               ||
                (\Auth::user()->hasRol('Gestor de notificación'))               ||
                (\Auth::user()->hasRol('Gestor de afiliación'))                 ||
                (\Auth::user()->hasRol('Gestor de publicación'))                ||
                (\Auth::user()->hasRol('Gestor de archivo'))                    ||
                (\Auth::user()->hasRol('Usuario general'))                    ){
                return $next($request);
            }else{
                return redirect('home');
            }
        }else{
            return redirect('/');
        }
    }
}

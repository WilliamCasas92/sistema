<?php

namespace App\Http\Middleware;

use Closure;

class CheckHistoriales
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            if (    (\Auth::user()->hasRol('Administrador')) ||
                (\Auth::user()->hasRol('Coordinador'))  ) {
                return $next($request);
            }else{
                return redirect('home');
            }
        }else{
            return redirect('/');
        }
    }
}

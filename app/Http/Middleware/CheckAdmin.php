<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            if (\Auth::user()->hasRol('Administrador')) {
                return $next($request);
            }else{
                return redirect('home');
            }
        }else{
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->hasRol('Administrador')) {
            return $next($request);
        }
        return redirect('home');
    }
}

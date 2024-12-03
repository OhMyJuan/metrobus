<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y si tiene el rol correcto
        if (Auth::check() && Auth::user()->rol == $role) {
            return $next($request);
        }

        // Si no tiene el rol adecuado, redirige al usuario a la página de inicio
        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/ingresar')->with('auth_requiered', 'Debes iniciar sesión primero.');
        }

        if (Auth::user()->rol !== 'admin') {
            return redirect('/')->with('error', 'No tienes permisos necesarios.');
        }

        return $next($request);
    }
}
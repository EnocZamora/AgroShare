<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale', 'es'));
        
        // Guardar en sesión si no existe para que el modal no se muestre de nuevo
        if (!session()->has('locale')) {
            session(['locale' => $locale]);
        }
        
        app()->setLocale($locale);

        return $next($request);
    }
}
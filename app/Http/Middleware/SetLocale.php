<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Idiomas soportados por la plataforma AgroShare.
     */
    protected array $supportedLocales = ['es', 'mi', 'cr'];

    public function handle(Request $request, Closure $next): Response
    {
        $sessionLocale = $request->session()->get('locale');

        $locale = in_array($sessionLocale, $this->supportedLocales, true)
            ? $sessionLocale
            : config('app.locale', 'es');

        if (!$request->session()->has('locale') || !in_array($request->session()->get('locale'), $this->supportedLocales, true)) {
            $request->session()->put('locale', $locale);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}

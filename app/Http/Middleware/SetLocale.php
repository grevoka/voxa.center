<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public const SUPPORTED = ['fr', 'en', 'es', 'de', 'pl'];

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        if ($locale && in_array($locale, self::SUPPORTED)) {
            app()->setLocale($locale);
            $request->route()->forgetParameter('locale');
        } else {
            app()->setLocale('fr');
        }

        return $next($request);
    }
}

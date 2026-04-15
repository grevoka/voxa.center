<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetClientLocale
{
    public function handle(Request $request, Closure $next)
    {
        $client = Auth::guard('client')->user();

        if ($client && in_array($client->locale, SetLocale::SUPPORTED)) {
            app()->setLocale($client->locale);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetAdminLocale
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && in_array($user->locale, ['en', 'fr'])) {
            app()->setLocale($user->locale);
        }

        return $next($request);
    }
}

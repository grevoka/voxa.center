<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSection
{
    public function handle(Request $request, Closure $next, string $section)
    {
        $user = Auth::user();

        if (!$user || !RolePermission::hasAccess($user->role, $section)) {
            abort(403, 'Acces non autorise.');
        }

        return $next($request);
    }
}

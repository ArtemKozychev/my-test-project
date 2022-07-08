<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (in_array($request->user()?->role, $roles)) {
            return $next($request);
        }

        throw new AuthorizationException(null, 403);
    }
}

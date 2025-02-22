<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException as CustomUnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($role) ? $role : explode('|', $role);

        if (!Auth::user()->hasAnyRole($roles)) {
            throw CustomUnauthorizedException::forRoles($roles);
        }

        return $next($request);
    }
}

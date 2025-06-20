<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirecToRolePanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            $currentRoute = $request->route()->getName();

            if ($user->hasRole('student') && !str_starts_with($currentRoute, 'student.')) {
                return redirect()->route('dashboard.index');
            }

            if (!$user->hasRole('student') && !str_starts_with($currentRoute, 'admin.')) {
                return redirect()->route('admin.dashboard');
            }
        }
        return $next($request);
    }
}

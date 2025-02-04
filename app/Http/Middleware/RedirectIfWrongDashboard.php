<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfWrongDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->id_role == 1 && $request->routeIs('user.dashboard')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->id_role != 1 && $request->routeIs('admin.dashboard')) {
            return redirect()->route('user.dashboard')->with('error', 'No tienes acceso a esta página.');
        }

        if ($user->id_role != 1 && !$user->hasVerifiedEmail() && !$request->routeIs('verification.notice')) {
            return redirect()->route('verification.notice')->with('error', 'Debes verificar tu correo antes de continuar.');
        }

        return $next($request);
    }
}

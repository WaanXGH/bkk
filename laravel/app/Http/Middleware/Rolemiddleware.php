<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check() && Auth::user()->role !== $role) {
            return redirect('/')->with('failed', 'Akses ditolak!');
        }

        return $next($request);
    }
}

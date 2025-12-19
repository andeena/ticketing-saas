<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login & role admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Access denied. Admin only.');
        }

        return $next($request);
    }
}

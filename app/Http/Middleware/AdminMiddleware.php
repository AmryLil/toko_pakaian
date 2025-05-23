<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_222405 === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Access denied.');
    }
}

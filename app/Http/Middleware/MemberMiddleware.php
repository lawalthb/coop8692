<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access. Member privileges required.');
        }

        return $next($request);
    }
}

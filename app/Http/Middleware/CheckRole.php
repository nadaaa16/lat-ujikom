<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }
        return redirect()->route('login')->with('error', 'Unauthorized.');
    }
}

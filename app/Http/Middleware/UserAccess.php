<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $userType
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (auth()->check() && auth()->user()->type == $userType) {
            return $next($request);
        }
        return response()->json(['You do not have permission to access this page.'], 403);
        // Alternatively, you can return a view for the error:
        // return response()->view('errors.check-permission', [], 403);
    }
}

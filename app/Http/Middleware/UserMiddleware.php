<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //User role = 2

        if (Auth::check()) {
            if (Auth::user()->role->id == 2) {
                return $next($request);
            } else {
                return redirect('/home')->with('message');
            }
        } else {
            return redirect('/login')->with('message');
        }
    }
}

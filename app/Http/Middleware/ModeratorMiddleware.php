<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Moderator role = 1
        if (Auth::check()) {
            if (Auth::user()->role->id == 1) {
                return $next($request);
            } else {
                return redirect('/home');
            }
        } else {
            return redirect('/login');
        }
    }
}

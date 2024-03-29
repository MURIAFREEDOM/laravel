<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (auth()->user()->type == 3) {
                return $next($request);            
            } elseif(auth()->user()->type !== 3) {
                return response()->redirect('/');
            } else {
                return response()->redirect('/laman');
            }    
        } else {
            return response()->redirect('/laman');
        }
    }
}

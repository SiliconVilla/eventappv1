<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('login');
        } elseif (auth()->user()->role == 0) {
            return $next($request);
        }elseif (auth()->user()->role == 1) {
            return $next($request);
        }elseif (auth()->user()->role == 2) {
            return $next($request);
        }elseif (auth()->user()->role == 9) {
            return $next($request);
        }elseif (auth()->user()->role == 10) {
            return $next($request);
        } else {
            return redirect('home');
        }

        
    }

     // en otro caso si el usuario tiene permisos con su rol puede acceder
   

    // si no se cumple ninguna de las condiciones anteriores es que no tiene permisos
    //return redirect('login');
}

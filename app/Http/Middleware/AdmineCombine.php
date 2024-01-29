<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdmineCombine
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('/login');
        }

        if (Auth::user()->id_role == 1 || Auth::user()->id_role == 2){
            return $next($request);
        }
        
        
        if (Auth::user()->id_role == 3) {
            return redirect()->route('/login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRouteDataMiddleware
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
        if(auth()->user()){
            //@todo tutaj zaimplementować sprawdzanie czy id w linku jest zalogowanego usera,
            // jak nie wrzucić go na logowanie lub na jego id
            dd($request);
            return $next($request);
        }
       return redirect('login');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        if(auth()->user()->uuid == Route::current()->originalParameter('tenant')){;
            return $next($request);
        } else if (auth()->user()) {

            return redirect()->to(route($request->session()->get('account_type')[0] . '.dashboard', ['tenant' => auth()->user()->uuid]));
        }
       return redirect('login');
    }
}

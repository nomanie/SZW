<?php

namespace App\Http\Middleware;

use App\Models\System\Workshop;
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
        if (auth()->user()->reset_password) {
            return redirect()->route('change_password');
        }
        if(auth()->user()->uuid == Route::current()->originalParameter('tenant') || Workshop::find(auth()->user()->worker->workshop_id)->uuid == Route::current()->originalParameter('tenant')){
            return $next($request);
        } else if (auth()->user()) {
            return redirect()->to(route($request->session()->get('account_type')[0] . '.dashboard', ['tenant' => auth()->user()->uuid]));
        }
       return redirect('login');
    }
}

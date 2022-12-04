<?php

namespace App\Http\Middleware;

use App\Models\System\Identity;
use App\Models\Workshop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkshopMiddleware
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
        dd('test');
        if (auth()->user() !== null && Workshop::where('identity_id', auth()->user()->id)->first()) {

            return $next($request);
        }
        return redirect('login');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AccesSalarie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
       
     
        if( Auth::user()->type_users == 'salarié')
        {
            return $next($request);
        }
    
        abort(403);
        
    }
}

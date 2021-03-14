<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AccesAdmin
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
        if( Auth::user()->type_users == 'admin')
        {
            return $next($request);
        }
     
        abort(403);
        
    }
}

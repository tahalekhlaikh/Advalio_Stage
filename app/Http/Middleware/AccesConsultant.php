<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AccesConsultant
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
 
        if( Auth::user()->type_users == 'consultant')
        {
            return $next($request);
        }
      

        abort(403);
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol)
    {
        $roles = (explode("|", $rol));

        foreach ($roles as $key => $rol) {
            if ($request->user()->role->nombre === $rol){
                return $next($request);
            }
        }
        abort(403);
    }

    
}

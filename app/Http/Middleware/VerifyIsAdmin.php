<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsAdmin
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
        if(!auth()->user()->is_admin()){
          return back();

        }
//        if (auth()->user()->is_admin()) {
//            return $next($request);
//        }else{
//            return abort(403, 'Unauthorized action.');
//        }
        return $next($request);
    }
}

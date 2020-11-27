<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsOrganization
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
        if(!auth()->user()->is_organization()){
            // return redirect('/admin/organization');
        }
        return $next($request);
//        if (auth()->user()->is_organization()) {
//            return $next($request);
//        }else{
//            return abort(403, 'Unauthorized action.');
//        }
    }
}

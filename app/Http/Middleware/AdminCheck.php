<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->get('user')){
            if(session()->get('user')['user_type'] == "Admin"){
                return $next($request);
            }
            else{
                return redirect('/');
            }
        }
        return redirect('/');
    }
}

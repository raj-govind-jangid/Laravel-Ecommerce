<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginMiddleware
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
        if($request->path()=="login" && $request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="register" && $request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="logout" && !$request->session()->has('user')){
            return redirect('/login');
        }
        elseif($request->path()=="forgetpassword" && $request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="changepassword" && $request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="changeemailaddress" && !$request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="changeuserpassword" && !$request->session()->has('user')){
            return redirect('/');
        }
        elseif($request->path()=="profile" && !$request->session()->has('user')){
            return redirect('/');
        }
        else{
            return $next($request);
        }
    }
}

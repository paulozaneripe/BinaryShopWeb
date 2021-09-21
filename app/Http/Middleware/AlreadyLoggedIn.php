<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        if(session()->has('LoggedUser') && 
        (url('login') == $req->url() || 
        url('register') == $req->url() ||
        url('forgot-password') == $req->url() ||
        url('reset-password') == $req->url())) {
            return redirect('/');
        }
        return $next($req);
    }
}

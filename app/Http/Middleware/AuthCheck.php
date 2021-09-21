<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AuthCheck
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
        if(!session()->has('LoggedUser')) {
            return redirect('/login')->withInput()->with('warning','Você precisa estar logado!');
        }

        return $next($req);
    }
}

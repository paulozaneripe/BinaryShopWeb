<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PCBuild;

class UserCheck
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
        $pcbuild = PCBuild::where('id','=',$req->route('id'))->first();
        if($pcbuild->user_id != session('LoggedUser')) {
            return back()->withInput()->with('fail','Você não tem autorização para acessar esta página.');
        }

        return $next($req);
    }
}

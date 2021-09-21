<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class IsAdmin
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
        $user = User::where('id','=',session('LoggedUser'))->first();
        if($user->is_admin == 1) {
            return $next($request);
        }

        return back()->with('fail','Você não tem autorização para acessar esta página.');
    }
}

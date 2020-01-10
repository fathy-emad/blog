<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        if(Auth::check()){
           $user = User::FindOrFail(Auth::id());
           if($user->role->name == 'admin' && $user->is_active == 1){
               return $next($request);
           }
        }

        return redirect('/');
    }
}

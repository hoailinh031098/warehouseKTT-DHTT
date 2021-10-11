<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkRoleUserDHTT
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
        $user=Auth::user();
        if ($user->role_id == 2) {
            return $next($request);
        }else{
            abort(404);
        }
    }
}

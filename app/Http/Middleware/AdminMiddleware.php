<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = 'administrator')
    {

        $user = Auth::user();        

        if(!$permission || !$user || !$user->can($permission)) {
        
            Auth::logout();

            return redirect()->route('login');
        
        }

        return $next($request);
    }
}

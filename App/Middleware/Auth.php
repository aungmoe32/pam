<?php

namespace App\Middleware;

use Closure;

class Auth
{
    public function handle($request, Closure $next, $guard = null)
    {
        // return redirect('/token');
        if(is_null(user())){
            return redirect('/login');
        }
        return $next($request);
    }
}

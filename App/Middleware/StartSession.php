<?php

namespace App\Middleware;

use App\Classes\Router;
use App\Classes\Session;
use Closure;
use Illuminate\Routing\Route;

class StartSession
{
    public function handle($request, Closure $next, $guard = null)
    {
        Session::start();
        $response = $next($request);
        Session::save($response);
        return $response;
    }
}

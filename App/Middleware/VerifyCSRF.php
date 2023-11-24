<?php

namespace App\Middleware;

use Closure;
use Exception;

class VerifyCSRF
{
    public function handle($request, Closure $next, $guard = null)
    {
        if($this->isReading($request) || $this->tokensMatch($request)){
            return $next($request);
        }

        throw new Exception("Token mismatch");
        
        
    }

    protected function tokensMatch($request)
    {
        // return true;
        return $request->input('_token') === session()->token();
    }

    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }
}

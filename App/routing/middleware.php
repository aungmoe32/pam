<?php

// Array middlewares

use App\Middleware\Auth;
use App\Middleware\VerifyCSRF;
use App\Middleware\StartSession;

return [

    'global' => [
        StartSession::class,
        VerifyCSRF::class
    ],


    'routeMiddleware' => [
        'auth' => Auth::class,
    ],


    
];

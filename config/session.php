<?php

use Illuminate\Support\Facades\App;

return [
    'session' => [
        'lottery' => [2, 100],
        'cookie' => 'app_session',
        'path' => '/',
        'domain' => '',
        'driver' => 'file',
        'files' => APP_ROOT.'/sessions',
        'lifetime' => 120,
        'expire_on_close' => false,
        'http_only' => true,
        'same_site' => 'lax',
        'secure' => false
    ]
];

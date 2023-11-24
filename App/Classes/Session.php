<?php


namespace App\Classes;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Session\SessionManager;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;


class Session
{

    public static $sessionManager = null;

    public static function start()
    {

        $container = new Container;
        // $container->instance('app', $container);

        $container['config'] = new Repository(require APP_ROOT . '/config/session.php');
        $container['files'] = new Filesystem;

        // beautify($container->make('config')->get('session'));



        // // Now we need to fire up the session manager
        $sessionManager = new SessionManager($container);
        static::$sessionManager = $sessionManager;  
        // static::$container = $container;
        $container['session.store'] = $sessionManager->driver();

        

        // // In order to maintain the session between requests, we need to populate the
        // // session ID from the supplied cookie
        $cookieName = $sessionManager->getName();

        if (isset($_COOKIE[$cookieName])) {
            if ($sessionId = $_COOKIE[$cookieName]) {
                $sessionManager->setId($sessionId);
            }
        }

        // // Boot the session
        $sessionManager->start();
    }

    public static function save(Response $response)
    {
        $config = static::$sessionManager->getSessionConfig();
        
        $cookie = new Cookie(
            static::$sessionManager->getName(),
            static::$sessionManager->getId(),
            time() + ($config['lifetime'] * 60),
            $config['path'],
            $config['domain'],
            $config['secure'] ?? false,
            $config['http_only'] ?? true,
            false,
            $config['same_site'] ?? null
        );
        $response->headers->setCookie($cookie);

        static::$sessionManager->save();
    }
}

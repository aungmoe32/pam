<?php

namespace App\Classes;

use App\Classes\Session;
use App\Middleware\Auth;
use Illuminate\Http\Request;
use App\Middleware\VerifyCSRF;
use App\Middleware\StartSession;
use Illuminate\Routing\Pipeline;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Router as IRouter;
use App\Classes\Request as ClassesRequest;

class Router
{
    protected $container = null;
    protected $request = null;
    public static $router = null;
    protected $globalMiddleware = null;

    public function __construct()
    {
        $this->init();
        $this->loadMiddlewares();
        $this->dispatch();
    }

    protected function init()
    {
        // Create a service container
        $this->container = new Container;

        // Create a request from server variables, and bind it to the container; optional
        $this->request = Request::capture();
        // $this->container->instance('Illuminate\Http\Request', $this->request);
        ClassesRequest::$request = $this->request;

        // Using Illuminate/Events/Dispatcher here (not required); any implementation of
        // Illuminate/Contracts/Event/Dispatcher is acceptable
        $events = new Dispatcher($this->container);

        // Create the router instance
        static::$router = new IRouter($events, $this->container);
        require_once APP_ROOT . '/App/routing/routes.php';
    }
    protected function loadMiddlewares()
    {
        $middlewares = require_once APP_ROOT . '/App/routing/middleware.php';
        $this->globalMiddleware = $middlewares['global'];

        // Load middlewares to router
        foreach ($middlewares['routeMiddleware'] as $key => $middleware) {
            static::$router->aliasMiddleware($key, $middleware);
        }
    }
    protected function dispatch()
    {
        try {
            // $response = $router->dispatch($request);
            $response = (new Pipeline($this->container))
                ->send($this->request)
                ->through($this->globalMiddleware)
                ->then(function ($request) {
                    return static::$router->dispatch($request);
                });
            // error_log(get_class($response));
            $response->send();
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo " <a href='/'>Home</a>";
        }
    }
}

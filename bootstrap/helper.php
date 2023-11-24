<?php

use App\Models\User;
use App\Classes\File;
use App\Classes\Router;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Database;
use Jenssegers\Blade\Blade;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\DatabasePresenceVerifier;

// use Illuminate\Contracts\Validation\Factory;

function view($name, $data = [])
{
    $blade = new Blade(APP_ROOT . '/resources/views', APP_ROOT.'/cache/views');
    return $blade->render($name, $data);
}
function storage()
{
    return File::$manager;
}
function request()
{
    return Request::$request;
}
function session()
{
    return Session::$sessionManager;
}
function redirect($to = null)
{
    if (is_null($to)) {
        return redirector();
    }

    return redirector()->to($to);
}

function redirector()
{
    $redirector = new Redirector(new UrlGenerator(router()->getRoutes(), request()));
    $redirector->setSession(session()->driver());
    return $redirector;
}

function router()
{
    return Router::$router;
}

function user()
{
    $user = User::find(session()->get('user_id'));
    return $user;
}

function beautify($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}
function validator()
{
    $loader = new FileLoader(new Filesystem, 'lang');
    $translator = new Translator($loader, 'en');
    $factory = new Factory($translator);

    if(is_null($factory->getPresenceVerifier())){
        $presenceVerifier = new DatabasePresenceVerifier(Database::$manager->getDatabaseManager());
        $factory->setPresenceVerifier($presenceVerifier);
    }
    

    return $factory;   
}

function asset($name){
    return URL.'/assets/'.$name;
}

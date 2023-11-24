<?php
use App\Models\Post;
use App\Classes\File;
use App\Classes\Router;
use App\Classes\Database;
use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Translation\Translator;

define("APP_ROOT",realpath(__DIR__."/../"));
define("URL","http://localhost:8000");


require APP_ROOT.'/vendor/autoload.php';

require_once APP_ROOT.'/config/_env.php';

new File;

new Database;

new Router;










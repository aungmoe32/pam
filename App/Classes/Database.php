<?php

namespace App\Classes;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static $manager = null;
    public function __construct()
    {
        // Create a new Capsule instance
        $capsule = new Capsule;

        static::$manager = $capsule;

        $configs = require APP_ROOT . '/config/database.php';


        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Add a database connection
        $capsule->addConnection($configs[getEnv('DB_CONNECTION')]);

        // Make this Capsule instance available globally (Capsule::table(...))
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM (global Eloquent capsule for connection)
        $capsule->bootEloquent();
    }
}

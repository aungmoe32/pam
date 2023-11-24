<?php

namespace App\Classes;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Filesystem\FilesystemManager;


class File
{

    public static $manager = null;

    function __construct()
    {
        $container = new Container;
        $container['config'] = new Repository(require APP_ROOT . '/config/file.php');

        $manager = new FilesystemManager($container);
        static::$manager = $manager;
    }
}







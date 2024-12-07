<?php

return [
        // 'default' => getenv('DB_CONNECTION'),


        'mysql' => [
                'driver' => 'mysql',
                'host' => getEnv('DB_HOST'),
                'port' => getEnv('DB_PORT'),
                'database' => getEnv('DB_DATABASE'),
                'username' => getEnv('DB_USERNAME'),
                'password' => getEnv('DB_PASSWORD'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
        ],

        'pgsql' => [
                'driver' => 'pgsql',
                'host' => getEnv('DB_HOST'),
                'port' => getEnv('DB_PORT'),
                'database' => getEnv('DB_DATABASE'),
                'username' => getEnv('DB_USERNAME'),
                'password' => getEnv('DB_PASSWORD'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'prefix'    => '',
        ]



];

<?php

use Illuminate\Database\Capsule\Manager as Capsule;

router()->get('/migrate', function () {
    // Read SQL file content
    $sqlFile = APP_ROOT . '/migration.sql';
    $sql = file_get_contents($sqlFile);

    try {
        // Execute the SQL statements
        Capsule::unprepared($sql);
        echo "SQL file executed successfully!";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
})->middleware();

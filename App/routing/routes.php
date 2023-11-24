<?php

// require_once __DIR__.'/example.php';

use App\Controllers\AuthController;
use App\Controllers\TodoController;

router()->get('/', function(){
    return redirect('/todos');
});

router()->group(['middleware' => 'auth', 'prefix' => 'todos'], function () {
    router()->get('', [TodoController::class, 'show']);
    router()->get('/delete/{id}', [TodoController::class, 'delete']);

    router()->post('/create', [TodoController::class, 'create']);
    router()->post('/save', [TodoController::class, 'save']);
    router()->get('/edit', [TodoController::class, 'edit']);
});


router()->get('/login', [AuthController::class, 'loginView']);
router()->get('/register', [AuthController::class, 'registerView']);
router()->get('/logout', [AuthController::class, 'logout']);
router()->post('/login', [AuthController::class, 'login']);
router()->post('/register', [AuthController::class, 'register']);

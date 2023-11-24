<?php

use Illuminate\Http\Response;



// session
router()->get('/token', function () {
    session()->put('app', 'test');
    beautify(session()->get('app'));
    // return session()->token();
});

// view
router()->get('/token', function () {
    $name = 'john';
    return view('app', compact('name'));
});

// validate
router()->get('/validate', function () {
    $rules = [
        'email' => 'required|email|unique:users',
        'name' => 'required',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
    ];
    $validator = validator()->make(request(), $rules);

    if ($validator->fails()) {
        $errors = $validator->errors();
        return ($errors);
    }
});

// file storage
router()->post('/post', function () {
    storage()->putFileAs('path',request()->img, 'test.png');
});


// route group middleware
router()->group(['namespace' => 'App\Controllers','middleware' => 'auth', 'prefix' => 'users'], function () {
    router()->get('/', ['name' => 'users.index', 'uses' => 'UsersController@index']);
    router()->post('/', ['name' => 'users.store', 'uses' => 'UsersController@store']);
});

// Redirect
router()->get('/menu', function () {
    return redirect('/bye');
    // return redirect()->back();
});

// Redirect
router()->name('home')->get('/', function () {
    return;
});

// catch-all route
router()->any('{any}', function () {
    return 'four oh four';
})->where('any', '(.*)');

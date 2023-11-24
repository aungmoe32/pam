<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Validation\DatabasePresenceVerifier;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login', ['errors' => session()->get('errors')]);
    }
    public function registerView()
    {
        // beautify(session());
        return view('auth.register', ['errors' => session()->get('errors')]);
    }


    public function register()
    {
        // dd(request()->toArray());
        $validator = validator()->make(
            request()->toArray(),
            [
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'password.confirmed' => ':attribute must same',
                'required' => ':attribute required!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            // beautify($errors);
            return redirect('/register')->withErrors($errors);
        }

        $user = new User();
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = password_hash(request()->password, PASSWORD_BCRYPT);
        $user->save();


        // return $user;
        return redirect('/login');


    }
    public function login()
    {
        $validator = validator()->make(
            request()->toArray(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            // beautify($errors);
            return redirect('/login')->withErrors($errors);
        }

        $user = User::where('email', request()->email)->first();
        if(is_null($user)){
            return redirect('/login')->withErrors(['invalid email']);
        }

        
        $check = password_verify(request()->password,$user->password);
        if(!$check){
            return redirect('/login')->withErrors(['invalid password']);
        }

        session()->put('user_id', $user->id);
        return redirect('/');

        
    }

    function logout(){
        session()->remove('user_id');
        return redirect('/login');
    }
}

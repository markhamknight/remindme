<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AuthController extends Controller
{
   

    public function login(Request $request)
    {
        $this->validate($request,[
            'username'  => 'required',
            'password'  => 'required'
        ]); 
        $credentials = array(
        'username'      => $request->username,
        'password'      => $request->password
        );
        if (Auth::attempt($credentials)) {
            flash()->success('Welcome '. Auth::user()->username);
            return redirect('reminders');
        }
            return redirect()->back()->withErrors([
                'login' => 'Invalid Username/Password'
            ]);
    }
    public function logout()
    {
        Auth::logout();
        return view('index');
    }
}

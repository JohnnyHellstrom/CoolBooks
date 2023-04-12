<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        
        /*$credentials = $request->validate([
            'email' =>['required', 'email'],
            'password' => ['required'],
            ]);*/
        $credentials = $request->only('email', 'password');
        

        if (Auth::attempt($credentials)) {
            // Authentication was successful...
            return redirect()->intended('/');
        }
        

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
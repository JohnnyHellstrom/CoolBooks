<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;


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

        //dd($credentials);

        if (!isset($credentials['email'])) {
            return back()->withErrors([
                'email' => 'The email field is required.',
            ]);
        }

        $user = User::where('email', $credentials['email'])->first();
        //dd($credentials);


        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        

        /*if (Auth::attempt($credentials)) {
            // Authentication was successful...
            Session::put('user_id', Auth::user()->id);
            return redirect()->intended('/');
        }*/
        if (Auth::attempt($credentials, true)) {
            // Authentication was successful...
            Session::put('user_id', Auth::user()->id);
            return redirect('/');
        }
        
        
        
        

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request) {
        Auth::logout(); // clears the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // redirect to login page
    }

}
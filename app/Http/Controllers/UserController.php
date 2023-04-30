<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.register');
    }
    // create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'user_name' => ['required', 'min:3'],
            'phone' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);
        // sets the created user to "user" and not deleted in the database as a default
        $formFields['role_id'] = 2;
        $formFields['is_deleted'] = 0;

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create the user
        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }


    public function login()
    {
        return view('users.login');
    }

    // authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'you are logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}

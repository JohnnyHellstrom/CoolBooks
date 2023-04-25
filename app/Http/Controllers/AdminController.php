<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //show all users
    public function index(User $user)
    {
        return view('/admin.index', ['users' => User::all()]);
    }

    //show single user
    public function show(User $user)
    {
        return view('/admin.show', ['users' => $user]);
    }

    //edit a user
    public function edit(Admin $admin)
    {
        return view('/admin.edit');
    }

    //delete a user
    public function destroy(Admin $admin)
    {
    }
}

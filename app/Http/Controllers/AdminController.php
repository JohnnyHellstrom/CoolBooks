<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //show all users
    public function index(User $user)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('/admin.index', ['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

            $formFields = $request->validate([
                'role_id' => 'required',
            ]);

            $formFields['is_deleted'] = 0;

            User::create($formFields);


            return redirect('/admin')->with('message', 'Role updated successfully!');
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        // dd($request->has('form1'));
        if ($request->has('role')) {
            $formFields = $request->validate([
                'role_id' => 'required',
            ]);

            $user->update($formFields);

            return back()->with('message', 'User updated successfully!');
        };
        // dd($request->has('form2'));
        if ($request->has('delete')) {
            $formFields = $request->validate([
                'is_deleted' => 'required',
            ]);

            $user->update($formFields);

            return back()->with('message', 'User updated successfully!');
        };
        // return back()->with('message', 'User updated successfully!');
    }

    //show single user
    public function show(User $user)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('/admin.show', ['users' => $user]);
    }

    //edit a user
    public function edit(User $user)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('/admin.edit', ['users' => $user]);
    }

    //delete a user
    public function destroy(Admin $admin)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
    }

    //info about user
    public function info(Admin $admin)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('/admin.info');
    }
}

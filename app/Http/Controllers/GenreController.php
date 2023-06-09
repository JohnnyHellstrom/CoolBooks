<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        // returns genres, that are not set as deleted, in alphabetical order
        $genres = Genre::where('is_deleted', false)->orderBy('name', 'asc')->paginate(5);
        return view('genres.index', ['genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $formFields['is_deleted'] = 0;

        Genre::create($formFields);

        return redirect('/genres')->with('message', 'Genre added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('genres.show', ['genre' => $genre]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('genres.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $genre->update($formFields);

        return redirect('/genres')->with('message', 'Genre updated successfully!');
    }

    /**
     * Show the form to confirm removal of a specific resource.
     */
    public function confirm_delete(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('genres.delete', ['genre' => $genre]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $genre->delete();
        return redirect('/genres')->with('message', 'Genre deleted successfully!');
    }

    /**
     * Show the form to confirm hiding of a specific resource.
     */
    public function confirm_hide(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('genres.hide', ['genre' => $genre]);
    }

    /**
     * Hide the specified resource from storage.
     */
    public function hide(Genre $genre)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $genre->update(['is_deleted' => '1']);
        return redirect('/genres')->with('message', 'Genre hidden successfully!');
    }
}

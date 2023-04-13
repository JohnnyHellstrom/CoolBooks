<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('genres.index', ['genres' => Genre::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Genre $genre)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Genre::create($formFields);

        return redirect('/genres')->with('message', 'Genre added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('genres.show', ['genre' => $genre]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
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
        return view('genres.delete', ['genre' => $genre]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect('/genres')->with('message', 'Genre deleted successfully!');
    }
}

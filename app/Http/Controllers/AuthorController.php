<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authors.index', ['authors' => Author::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        Author::create($formFields);

        return redirect('/authors')->with('message', 'Author added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('authors.show', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $author->update($formFields);

        return redirect('/authors')->with('message', 'Author updated successfully!');
    }

    /**
     * Show the form to confirm removal of a specific resource.
     */
    public function delete(Author $author)
    {
        return view('authors.delete', ['author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/authors')->with('message', 'Author deleted successfully!');
    }
}

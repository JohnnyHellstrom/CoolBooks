<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // returns authors, that are not set as deleted, in a sorted order and paginated
        $authors = Author::where('is_deleted', false)->filter(request(['search']))->orderBy('last_name', 'asc')->paginate(5);
        return view('authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'biography' => 'required',
        ]);

        $formFields['is_deleted'] = 0;

        if($request->hasFile('author_image')) {
            $formFields['author_image'] = $request->file('author_image')->store('authors', 'public');
        }

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
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'biography' => 'required',
        ]);

        $formFields['is_deleted'] = 0;

        if ($request->hasFile('author_image')) {
            $formFields['author_image'] = $request->file('author_image')->store('authors', 'public');
        }

        $author->update($formFields);

        return redirect('/authors')->with('message', 'Author updated successfully!');
    }

    /**
     * Show the form to confirm removal of a specific resource.
     */
    public function confirm_delete(Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('authors.delete', ['author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $author->delete();
        return redirect('/authors')->with('message', 'Author deleted successfully!');
    }

    /**
     * Show the form to confirm hiding of a specific resource.
     */
    public function confirm_hide(Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('authors.hide', ['author' => $author]);
    }

    /**
     * Hide the specified resource from all access.
     */
    public function hide(Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $author->update(['is_deleted' => '1']);
        return redirect('/authors')->with('message', 'Author hidden successfully!');
    }
}

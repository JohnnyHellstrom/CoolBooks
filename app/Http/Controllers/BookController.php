<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', ['books' => Book::latest()->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Genre $genre, User $user)
    {
        return view('books.create',
        [
            'genres' => $genre->all(),
            'users' => $user->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {           
        $formFields = $request->validate([
            'genre_id' => 'required',
            'user_id' => 'required',            
            'title' => 'required',
            'ISBN' => ['required', Rule::unique('books', 'ISBN')],
            'tags' => 'required',
            'description' => 'required',
        ]);        
        
        $formFields['is_deleted'] = 0;
        // $formFields['user_id'] = auth()->id();
        
        Book::create($formFields);
      
        return redirect('/')->with('message', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show',
        [
            'books' => $book                       
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Genre $genre, User $user)
    {        
        return view('books.edit',
        [
            'books' => $book,
            'genres' => $genre->all(),
            'users' => $user->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * -Add something for the admin if its deleted or not?
     */
    public function update(Request $request, Book $book)
    {       
        $formFields = $request->validate([
            'genre_id' => 'required',
            'user_id' => 'required',            
            'title' => 'required',
            'ISBN' => ['required'],
            'tags' => 'required',
            'description' => 'required',
        ]);            
        
        $book->update($formFields);
      
        return back()->with('message', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // dd($book);
        $book->delete();
        return redirect('/')->with('message', 'Book deleted successfully');
    }
}

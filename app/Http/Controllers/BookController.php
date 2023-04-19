<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\AuthorBook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // only returns the books that are not set "deleted" in the database...
        return view('books.index', ['books' => Book::where('is_deleted', false)->latest()->filter(request(['tag', 'search']))->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Genre $genre, Author $author)
    {
        return view('books.create',
        [
            'genres' => $genre->all(),
            'authors' => $author->all()                   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {           
        $formFields = $request->validate([
            'genre_id' => 'required',
            'author_id' => 'required',                       
            'title' => 'required',
            'ISBN' => ['required', Rule::unique('books', 'ISBN')],
            'tags' => 'required',
            'description' => 'required',            
        ]);        
        // adding extra stuff from without the form
        $formFields['is_deleted'] = 0;
        // this is a laravel thing that grabs the user_id from the auth()->id();
        $formFields['user_id'] = auth()->id();
     
        // for adding the image to the book
        if($request->hasFile('book_img')){
            $formFields['image'] = $request->file('book_img')->store('book_images', 'public');
        }
        // getting the bookid from the create input
        $newBookId = Book::create($formFields);

        $authorBook = [
            'author_id' => $formFields['author_id'],
            'book_id' => $newBookId->id,
        ];    
        // putting in the join table
        AuthorBook::create($authorBook);

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
    public function edit(Book $book, Genre $genre, Author $author)
    {        
        return view('books.edit',
        [
            'books' => $book,
            'genres' => $genre->all(),
            'authors' => $author->all(),            
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
            'author_id' => 'required',                       
            'title' => 'required',
            'ISBN' => ['required'],
            'tags' => 'required',
            'description' => 'required',
        ]);    
        
        // getting the logged in user id
        $formFields['user_id'] = auth()->id();

        // for adding the image to the book
        if($request->hasFile('book_img')){
            $formFields['image'] = $request->file('book_img')->store('book_images', 'public');
        }      
        
        // updating the pivot table
        AuthorBook::where('book_id', $book['id'])->update(['author_id' => $formFields['author_id']]);

        $book->update($formFields);
      
        return back()->with('message', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Book $book)
    // {        
    //     $book->delete();
    //     return redirect('/')->with('message', 'Book deleted successfully');
    // }

    public function destroy(Book $book)
    {
        $book->update(['is_deleted' => '1']);

        return redirect('/')->with('message', 'Book deleted successfully');
    }
}

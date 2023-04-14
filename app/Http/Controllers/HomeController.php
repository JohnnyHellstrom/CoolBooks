<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('home.index');
    // }
    public function index(Book $book)
    {
        // dd($book);
        $rand_book = random_int(1, 9);
        return view('/home.index', ['books' => Book::all(), 'one_book' => Book::find($rand_book), 'rand_rating' => Review::find($rand_book), 'rating' => Review::find(1), 'authors' => Author::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }
    public function show(Book $book)
    {
        dd($book);
        $randomBook = Book::find(random_int(1,4));
        return view('/partials._hero',
        [
            'books' => $randomBook
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

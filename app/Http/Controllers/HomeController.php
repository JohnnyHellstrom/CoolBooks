<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        // Session::flush();

        // Auth::logout();

        // return redirect('login');
        // dd('hej');
        //Get 3 random books in a genre
        $rand_genre = random_int(1, count(Genre::all()));

        $one_book = Book::where('is_deleted', false)->inRandomOrder()->limit(1)->first();
        // dd($one_book);
        // $contentToBookRow = Genre::getThreeBooksFromThreeGenre();
        // dd($contentToBookRow);
        $genre_comedy = Book::getGenre(1);
        $genre_horror = Book::getGenre(2);
        $genre_romance = Book::getGenre(3);

        return view('/home.index', ['books' => Book::all(), 'authors' => Author::all(), 'horror' => $genre_horror, 'romance' => $genre_romance, 'one_book' => $one_book, 'comedy' => $genre_comedy]);
    }

    public function rotatingHead()
    {
        $bookForRotating = Book::with('authors')->get();
        $response = response()->json($bookForRotating);        

        return $response;
    }

    public function about()
    {
        return view('/home.about');
    }

    public function contact()
    {
        return view('/home.contact');
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
        // returns authors, that are not set as deleted, in a sorted order and paginated
        $genre_book = Book::where('is_deleted', false)->where('genre', 'horror')->paginate(3);
        dd($genre_book);
        return view('/home.index', ['genre' => $genre_book]);
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

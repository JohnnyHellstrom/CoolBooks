<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Book $book)
    {
        $genreIds = Book::getThreeRandomGenreIds();

        $genre_comedy = Book::getBooksByGenre($genreIds[0]);
        $genre_horror = Book::getBooksByGenre($genreIds[1]);
        $genre_romance = Book::getBooksByGenre($genreIds[2]);

        return view('/home.index', ['horror' => $genre_horror, 'romance' => $genre_romance, 'comedy' => $genre_comedy]);
    }

    public function rotatingHead()
    {
        $bookForRotating = Book::with('authors')
        ->select('*', DB::raw('ROUND((SELECT AVG(rating) FROM reviews WHERE reviews.book_id = books.id), 1) as average_rating'))
        ->inRandomOrder()->take(5)->get();
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

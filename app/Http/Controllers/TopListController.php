<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TopListController extends Controller
{
    public function index($order = 'desc')
    {
        $booksHighest = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
        ->selectRaw('books.id,books.image,books.title, AVG(reviews.rating) as avg_rating')
        ->groupBy('books.id','books.title','books.image')
        ->orderByDesc('avg_rating', $order)
        ->limit(3)
        ->get();

        $booksLowest = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
        ->selectRaw('books.id,books.image,books.title, AVG(reviews.rating) as avg_rating')
        ->groupBy('books.id','books.title','books.image')
        ->orderByDesc('avg_rating', $order == 'desc' ? 'asc' : 'asc')
        ->limit(3)
        ->get();
        return view('toplist.index', [
            'booksHighest' => $booksHighest,
            'booksLowest' => $booksLowest,
            'order' => $order,
        ]);
    }
    public function mostReviewed()
    {
        $books = Book::withCount('reviews')
        ->has('reviews')
        ->orderByDesc('reviews_count')
        ->limit(3)
        ->get();

        return view('toplist.index',[
            'booksMostReviewd' => $books,
        ]);
    }
    
}

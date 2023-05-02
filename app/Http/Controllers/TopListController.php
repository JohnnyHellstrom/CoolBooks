<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TopListController extends Controller
{
        public function highestRating($order = 'desc')
    {
        $booksHighest = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->selectRaw('books.id,books.image,books.title, AVG(reviews.rating) as avg_rating')
            ->groupBy('books.id','books.title','books.image')
            ->orderByDesc('avg_rating', $order)
            ->limit(5)
            ->get();

        return $booksHighest;
    }

    public function lowestRating($order = 'desc')
    {
        $booksLowest = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->selectRaw('books.id,books.image,books.title, AVG(reviews.rating) as avg_rating')
            ->groupBy('books.id','books.title','books.image')
            ->orderBy('avg_rating', $order == 'asc' ? 'asc' : 'desc')
            ->limit(5)
            ->get();

        return $booksLowest;
    }
    public function mostReviewed($order = 'desc')
    {
        $booksmostReviewed = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
        ->selectRaw('books.id,books.image,books.title, COUNT(reviews.id) as review_count')
        ->groupBy('books.id', 'books.title', 'books.image')
        ->orderBy('review_count', $order)
        ->limit(5)
        ->get();
        return $booksmostReviewed;
    }

    public function index($order = 'desc')
{
    $booksHighest = $this->highestRating($order);
    $booksLowest = $this->lowestRating($order == 'asc' ? 'desc' : 'asc');
    $booksmostReviewed = $this->mostReviewed($order);

    return view('toplist.index', [
        'booksHighest' => $booksHighest,
        'booksLowest' => $booksLowest,
        'booksmostReviewed' => $booksmostReviewed,
        'order' => $order,
    ]);
}
    
}

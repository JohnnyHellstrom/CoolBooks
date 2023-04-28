<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TopListController extends Controller
{
    public function ratings()
    {
        $books = Book::all()->map(function ($book) {
            return $book->setRelation('reviews', $book->reviews->sortByDesc('rating')->take(3))
                        ->setAttribute('reviews_avg_rating', $book->getAverageRating());
        });
    
        $bestRatedBooks = $books->sortByDesc('reviews_avg_rating')->take(3);
        $worstRatedBooks = $books->sortBy('reviews_avg_rating')->take(3);
    
        return view('toplist.toplist', [
            'bestRatedBooks' => $bestRatedBooks,
            'worstRatedBooks' => $worstRatedBooks,
        ]);
    }
    
}

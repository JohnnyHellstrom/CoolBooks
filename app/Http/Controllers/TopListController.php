<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TopListController extends Controller
{
    /*public function ratings()
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
    }*/
  /*  public function show($id)
{
    $book = Book::findOrFail($id);

    return view('book', [
        'book' => $book,
    ]);
}*/

public function highestRating()
{
    $books = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
        ->selectRaw('books.id,books.image,books.title, AVG(reviews.rating) as avg_rating')
        ->groupBy('books.id','books.title','books.image')
        ->orderByDesc('avg_rating')
        ->limit(3)
        ->get();

return view('toplist.index', [
    'books' => $books,
]);
}










    
}

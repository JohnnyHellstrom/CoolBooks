<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {       
        $searchTerm = $request->input('search');
        $searchType = $request->input('type');        
        $query = Book::query();

        // if the user clicks on the tag in the book page
        if($request->has('tag'))
        {
            $tag = $request->input('tag');
            $query->where('tags', 'like', '%'. $tag . '%');
        } 

        switch ($searchType) 
        {
            case 'genre':
                $query->whereHas('genres', function($question) use ($searchTerm) {
                    $question->where('name', 'like', '%' . $searchTerm . '%');
                });
                break;
            case 'author':
                $query->whereHas('authors', function($question) use ($searchTerm) {
                    $question->where('first_name', 'like', '%' . $searchTerm . '%');
                });
                break;
            default:
                $query->where('title', 'like', '%' . $searchTerm . '%');
                break;
        }

        $books = $query->paginate(10);    
        return view('search.index', ['books' => $books]);
    }
}

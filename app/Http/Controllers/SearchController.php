<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Role;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {       
        abort_if(auth()->user()->role_id != Role::IS_USER, 403, 'Page doesnt exist');

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
                    $question->where('first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                        ->orWhereRaw('concat(first_name, " ", last_name) like ?', '%' .$searchTerm . '%');
                });
                /*
                    the ? is used as a placeholder for the search term variable, which is passed as a parameter to the orWhereRaw method.                 
                    When the query is executed, the search term variable is replaced with the actual value of the $searchTerm variable. 
                    The ? placeholder helps to prevent SQL injection attacks by ensuring that the search term variable is properly 
                    escaped and quoted before it is inserted into the SQL query.
                */
                break;
            default:
                $query->where('title', 'like', '%' . $searchTerm . '%');
                break;
        }

        $books = $query->paginate(10);    
        return view('search.index', ['books' => $books]);
    }
}

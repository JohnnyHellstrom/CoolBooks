<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    public function index(Book $book)
    {
        return view('/bookLists.index', ['users' => Book::all()]);
    }
}

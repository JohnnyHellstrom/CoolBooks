<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Role;
use App\Models\Genre;
use App\Models\Author;
use App\Models\AuthorBook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        //Save request to keep selected dropdown when reloading chart page
        $selected = $request->sortOrder;

        //Set orderBy parameters
        switch ($request->sortOrder) {
            case 'Title, A to Ö':
                $sortBy = 'title';
                $order = 'asc';
                break;
            case 'Title, Ö to A':
                $sortBy = 'title';
                $order = 'desc';
                break;
            case 'Last updated':
                $sortBy = 'updated_at';
                $order = 'desc';
                break;
            default:    //Same as 'Title, A to Ö'
                $sortBy = 'title';
                $order = 'asc';
                break;
        }
        // only returns the books that are not set "deleted" in the database...
        $books = Book::with('authors')->with('genres')->where('is_deleted', false)->orderBy($sortBy, $order)->paginate(10);
        return view('books.index', ['books' => $books, 'selected' => $selected]);
    }

    public function create(Genre $genre, Author $author)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('books.create',
        [
            'genres' => $genre->all(),
            'authors' => $author->all()                   
        ]);
    }

    public function store(Request $request)
    {         
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

        $formFields = $request->validate([
            'genre_id' => 'required',
            'author_id' => 'required',                       
            'title' => 'required',
            'ISBN' => ['required', Rule::unique('books', 'ISBN')],
            'tags' => 'required',
            'description' => 'required',            
        ]);        
        // adding extra stuff from without the form
        $formFields['is_deleted'] = 0;
        // this is a laravel thing that grabs the user_id from the auth()->id();
        $formFields['user_id'] = auth()->id();
     
        // for adding the image to the book
        if($request->hasFile('book_img')){
            $formFields['image'] = $request->file('book_img')->store('book_images', 'public');
        }
        // getting the bookid from the create input
        $newBookId = Book::create($formFields);

        $authorBook = [
            'author_id' => $formFields['author_id'],
            'book_id' => $newBookId->id,
        ];    
        // putting in the join table
        AuthorBook::create($authorBook);

        return redirect('/')->with('message', 'Book created successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show',
        [
            'books' => $book                       
        ]);
    }

    public function edit(Book $book, Genre $genre, Author $author)
    {        
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

        return view('books.edit',
        [
            'books' => $book,
            'genres' => $genre->all(),
            'authors' => $author->all(),            
        ]);
    }

    public function update(Request $request, Book $book)
    {    
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

        $formFields = $request->validate([
            'genre_id' => 'required', 
            'author_id' => 'required',                       
            'title' => 'required',
            'ISBN' => ['required'],
            'tags' => 'required',
            'description' => 'required',
        ]);    
        
        // getting the logged in user id
        $formFields['user_id'] = auth()->id();

        // for adding the image to the book
        if($request->hasFile('book_img')){
            $formFields['image'] = $request->file('book_img')->store('book_images', 'public');
        }      
        
        // updating the pivot table
        AuthorBook::where('book_id', $book['id'])->update(['author_id' => $formFields['author_id']]);

        $book->update($formFields);
      
        return back()->with('message', 'Book updated successfully!');
    }

    public function confirm_delete(Book $book)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('books.delete', ['book' => $book]);
    }

    public function destroy(Book $book)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $book->delete();
        return redirect('/books')->with('message', 'Book deleted successfully!');
    }

    public function confirm_hide(Book $book)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        return view('books.hide', ['book' => $book]);
    }

    public function hide(Book $book)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $book->update(['is_deleted' => '1']);
        return redirect('/books')->with('message', 'Book hidden successfully!');
    }


    public function livesearch(Request $request)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');
        if($request->ajax())
        {
            $output = '';
            $searchedBooks = Book::where('title', 'LIKE', '%'.$request->livesearch.'%')
                    ->orWhere('description', 'LIKE', '%'.$request->livesearch.'%')
                    ->get();
            
            if($searchedBooks)
            {
                foreach($searchedBooks as $book)
                {
                    $output .=
                    '
                        <div class="card mt-2" style="width: 18rem;">
                            <a href="./books/'. $book->id .'">
                                <img src="'. ($book->image ? asset('storage/' . $book->image) : asset('images/no-image.png')) .'" style="height:10rem">
                            </a>
                                <div class="card-body">                                                    
                                    <p>'.$book->title.'</p>
                                    <p>'.$book->description.'</p> 
                                </div> 
                        </div>
                    ';
                }
            }
            return response()->json($output);
        }
        return view('books.livesearch');
    }
}

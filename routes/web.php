<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubCommentController;
use App\Models\Role;
use App\Models\Subcomment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Books //
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/create', [BookController::class, 'create']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{book}/edit', [BookController::class, 'edit']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
Route::get('/books/{book}', [BookController::class, 'show']);


// Authors
Route::get('/authors', [AuthorController::class, 'index']);                             //Show all authors
Route::get('/authors/create', [AuthorController::class, 'create']);                     //Show create author form
Route::post('/authors', [AuthorController::class, 'store']);                            //Store new author
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit']);                //Show edit author form
Route::put('/authors/{author}', [AuthorController::class, 'update']);                   //Update author
Route::get('/authors/{author}/delete', [AuthorController::class, 'confirm_delete']);    //Show delete author form
Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);               //Delete author
Route::get('/authors/{author}', [AuthorController::class, 'show']);                     //Show selected author - keep as last

// Users
Route::get('/users', [UserController::class, 'index']);


//Genres
Route::get('/genres', [GenreController::class, 'index']);                               //Show all genres
Route::get('/genres/create', [GenreController::class, 'create']);                       //Show create genre form
Route::post('/genres', [GenreController::class, 'store']);                              //Store new genre
Route::get('/genres/{genre}/edit', [GenreController::class, 'edit']);                   //Show edit genre form
Route::put('/genres/{genre}', [GenreController::class, 'update']);                      //Update genre
Route::get('/genres/{genre}/delete', [GenreController::class, 'confirm_delete']);       //Show delete genre form
Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);                  //Delete genre
Route::get('/genres/{genre}', [GenreController::class, 'show']);                        //Show selected genre - keep as last


//Reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::put('/reviews/{review}', [ReviewController::class, 'update']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
Route::post('/reviews/like/{review}', [ReviewController::class, 'like']);

//Comments
Route::post('/comments', [CommentController::class, 'store']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
Route::post('/comments/flag/{comment}', [CommentController::class, 'flag']);

//SubComments
Route::post('/subcomments', [SubCommentController::class, 'store']);

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


//Home
Route::get('/',[HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);


/*Route::get('/', function () {
    return view('welcome');
});*/

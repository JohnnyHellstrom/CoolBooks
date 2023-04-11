<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReviewController;

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
Route::get('/books/{book}', [BookController::class, 'show']);


// Authors
Route::get('/authors', [AuthorController::class, 'index']);


// Users
Route::get('/users', [UserController::class, 'index']);


//Genres
Route::get('/genres', [GenreController::class, 'index']);


//Reviews
Route::get('/reviews', [ReviewController::class, 'index']);


//Home
Route::get('/',[HomeController::class, 'index']);
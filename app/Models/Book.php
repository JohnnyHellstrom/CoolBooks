<?php

namespace App\Models;

use PhpParser\Node\Expr\FuncCall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'ISBN', 'genre_id', 'user_id', 'tags', 'description', 'is_deleted', 'image'];
   
    public function getAverageRating()
    {
        $rating = $this->reviews()->pluck('rating')->avg();
        return $rating;
    }
    
    public static function getBooksByGenre($id)
    {
        $genre_comedy = Book::where('is_deleted', false)->where('genre_id', $id)->inRandomOrder()->limit(3)->get();
        return $genre_comedy;
    }

    //Returns all distinct genre_ids from book-table 
    public static function getThreeRandomGenreIds()
    {
        $rows = Book::select('genre_id')->distinct()->inRandomOrder()->Limit(3)->get();
        $id[] = $rows[0]['genre_id'];
        $id[] = $rows[1]['genre_id'];
        $id[] = $rows[2]['genre_id'];
        return $id;
    }

   
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genres(){
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'book_id')->orderBy('created_at', 'desc');
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'author_books');
    }
}

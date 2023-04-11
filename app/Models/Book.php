<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

   
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }

    public function genres(){
        return $this->hasMany(Genre::class, 'genre_id');
    }

    public function reviews(){
        return $this->belongsTo(Review::class, 'book_id');
    }

    public function authors(){
        return $this->belongsTo(Author::class, 'author_book');
    }
}

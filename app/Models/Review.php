<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    //Relationship
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }

    public function books(){
        return $this->hasMany(Book::class, 'book_id');
    }
}

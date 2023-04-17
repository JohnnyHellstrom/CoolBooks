<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id' , 'headline', 'review_text', 'rating', 'is_deleted'];

    //Relationship
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }

    public function books(){
        return $this->hasMany(Book::class, 'book_id');
    }
    public function likedreviews(){
        return $this->belongsTo(LikedReview::class, 'review_id');
    }
    public function comments(){
        return $this->belongsTo(Comment::class, 'review_id');
    }
}

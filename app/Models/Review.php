<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id' , 'headline', 'review_text', 'rating', 'is_deleted'];

    public function numberOfLikes($id){
        $likes = LikedReview::where('review_id', '=', $id)
                        ->where('liked', '=', '1')->count();
        return $likes;
    }

    public function numberOfDislikes($id){
        $likes = LikedReview::where('review_id', '=', $id)
                        ->where('liked', '=', '0')->count();
        return $likes;
    }

    //Relationship
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books(){
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function likedreviews(){
        return $this->hasMany(LikedReview::class, 'review_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'review_id')->orderBy('created_at', 'desc');
    }


}

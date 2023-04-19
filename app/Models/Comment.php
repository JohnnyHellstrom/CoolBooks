<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'review_id', 'user_id', 'is_deleted'];

    // Relationships
    public function reviews(){
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subcomments(){
        return $this->hasMany(Subcomment::class, 'comment_id');
    }
    // Is called from review to return a collection of subcomments to the collection of comments
    // public function commentRecursive(){
    //     return $this->comments()->with('subcomments');
    // }
}

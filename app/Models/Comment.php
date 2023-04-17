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
        return $this->hasMany(LikedReview::class, 'review_id');
    }
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }
    public function subcomments(){
        return $this->belongsTo(SubComment::class, 'comment_id');
    }
}

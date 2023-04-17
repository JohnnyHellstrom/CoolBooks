<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedReview extends Model
{
    use HasFactory;

    protected $fillable = ['liked'];

    // Relationships
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'review_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcomment extends Model
{
    use HasFactory;

    protected $fillable = ['subcomment', 'comment_id', 'user_id', 'is_deleted'];

    // Relationships
    public function comments(){
        return $this->hasMany(Comment::class, 'comment_id');
    }
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }
}

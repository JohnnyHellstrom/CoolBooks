<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'ISBN', 'genre_id', 'user_id', 'tags', 'description', 'is_deleted', 'image'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false)
        { // sql like query 
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false)
        { // sql like query 
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
   
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genres(){
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'book_id');
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'author_books');
    }
}

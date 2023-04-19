<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'author_image', 'biography', 'is_deleted'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('first_name', 'like', '%' . request('search') . '%')
                ->orWhere('last_name', 'like', '%' . request('search') . '%')
                ->orWhere('biography', 'like', '%' . request('search') . '%');
        }
    }

    //Relationships
    public function books(){
        return $this->belongsToMany(Book::class, 'author_books');
    }
}

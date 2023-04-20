<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_deleted'];

    //Relationship
    public function books(){
        return $this->hasMany(Book::class, 'genre_id');
    }
}

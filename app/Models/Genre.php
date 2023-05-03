<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_deleted'];


    //Relationship
    public function books(){
        return $this->hasMany(Book::class, 'genre_id');
    }
}

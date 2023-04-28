<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreQuote extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_deleted'];

    //Relationship
    public function quotes(){
        return $this->hasMany(Quotes::class, 'genre_qoute_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['genre_quote_id', 'user_id', 'quote',  'quotee', 'is_deleted', 'is_moderated'];

   
    //Relationships
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genrequotes(){
        return $this->belongsTo(GenreQuote::class, 'genre_quote_id');
    }
}

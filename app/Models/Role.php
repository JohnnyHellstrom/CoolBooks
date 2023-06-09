<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // created for easier checks from the database, and easier to read than a number
    public const IS_ADMIN = 1;
    public const IS_USER = 2;
    public const IS_MODERATOR = 3;

    //Relationships
    public function user(){
        return $this->hasMany(User::class, 'role_id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcomment extends Model
{
    use HasFactory;

    protected $fillable = ['subcomment', 'comment_id', 'user_id', 'is_deleted'];    

    public function timeSinceReply(){
        $now = Carbon::now();
        $postedAt = Carbon::parse($this->attributes['created_at']);
        $diff = $postedAt->diffInHours($now);
        $diff += 1;
        switch ($diff) {
            case $diff < 24:
                return "{$diff}h";
                break;
            case $diff < 168:
                $diffDays = $postedAt->diffInDays($now);
                return "{$diffDays}d";
                break;
            case $diff < 672:
                $diffWeeks = $postedAt->diffInWeeks($now);
                return "{$diffWeeks}w";
                break;
            case $diff < 8760:
                $diffMonths = $postedAt->diffInMonths($now);
                return "{$diffMonths}m";
                break;
            default:
                $diffYears = $postedAt->diffInYears($now);
                return "{$diffYears}y";
            }
        //return "for {$diff} hours ago";
    }

    // Relationships
    public function comments(){
        return $this->belongsTo(Comment::class, 'comment_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

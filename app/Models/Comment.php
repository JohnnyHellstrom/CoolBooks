<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'review_id', 'user_id', 'is_deleted'];

    public function timeSincePost(){
        $now = Carbon::now();
        $postedAt = Carbon::parse($this->attributes['created_at']);
        $diff = $postedAt->diffInHours($now);
        $diff += 1;
        switch ($diff) {
            case $diff < 24:
                return "for {$diff} hours ago";
                break;
            case $diff < 168:
                $diffDays = $postedAt->diffInDays($now);
                return "for {$diffDays} days ago";
                break;
            case $diff < 672:
                $diffWeeks = $postedAt->diffInWeeks($now);
                return "for {$diffWeeks} weeks ago";
                break;
            case $diff < 8760:
                $diffMonths = $postedAt->diffInMonths($now);
                return "for {$diffMonths} months ago";
                break;
            default:
                $diffYears = $postedAt->diffInYears($now);
                return "for {$diffYears} years ago";
            }
        return "for {$diff} hours ago";
    }

    // Relationships
    public function reviews(){
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subcomments(){
        return $this->hasMany(Subcomment::class, 'comment_id')->orderBy('created_at', 'desc');
    }

}

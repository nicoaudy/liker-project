<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];

    protected $appends = ['likeCount', 'likedByCurrentUser', 'canBeLikedByCurrentUser'];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
        if (auth()->check()) {
            return false;
        }

        return $this->likes->where('user_id', auth()->user()->id)->count() === 1;
    }

    public function getCanBeLikedByCurrentUserAttribute()
    {
        return $this->user->id !== auth()->user()->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}

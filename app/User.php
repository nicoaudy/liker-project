<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Add some additional avatar attribute using getAvatarAttribute()
    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
        return 'http://gravatar.com/avatar/' . md5($this->email) . '?s=45&d=mm';
    }
}

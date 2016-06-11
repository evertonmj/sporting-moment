<?php

namespace app;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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

    public function events() {
      return $this->belongsToMany('App\Event', 'user_event');
    }

    public function moments() {
      return $this->belongsToMany('App\Moment', 'user_moment');
    }
}

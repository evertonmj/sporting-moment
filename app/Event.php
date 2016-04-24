<?php

namespace Sporting Moment;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";
    //

    public function teams() {
      return $this->belongsToMany('App\Team', 'team_event');
    }

    public function users() {
      return $this->belongsToMany('App\User', 'user_event');
    }

    public function moments() {
      return $this->hasMany(Moment::class);
    }
}

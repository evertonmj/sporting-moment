<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $table = "moment";
    //

    public function event() {
      return $this->belongsTo(Event::class);
    }

    public function teams() {
      return $this->belongsToMany('App\Team', 'team_moment');
    }

    public function users() {
      return $this->belongsToMany('App\User', 'user_moment')
    }
}

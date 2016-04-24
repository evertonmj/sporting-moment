<?php

namespace Sporting Moment;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $team = "team";
    //

    public function events() {
      return $this->belongsToMany('App\Event', 'team_event');
    }

    public function moments() {
      return $this->belongsToMany('App\Moment', 'team_moment');
    }
}

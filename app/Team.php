<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $team = "team";

    protected $fillable = ['name', 'description'];
    //

    public function events() {
      return $this->belongsToMany('App\Event', 'team_event');
    }

    public function moments() {
      return $this->belongsToMany('App\Moment', 'team_moment');
    }
}

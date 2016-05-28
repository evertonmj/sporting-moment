<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "team";

    protected $fillable = ['name', 'description'];
    //

    public function events() {
      return $this->belongsToMany('app\Event', 'team_event');
    }

    public function moments() {
      return $this->belongsToMany('app\Moment', 'team_moment');
    }
}

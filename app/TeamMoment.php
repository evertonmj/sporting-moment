<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class TeamMoment extends Model
{
    protected $table = "team_moment";
    //

    public function team() {
      return $this->belongsTo(Team::class);
    }

    public function moment() {
      return $this->belongsTo(Moment::class);
    }
}

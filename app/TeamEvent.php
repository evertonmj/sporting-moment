<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class TeamEvent extends Model
{
    protected $table = "team_event";

    public function teams() {
      return $this->belongsTo(Team::class);
    }

    public function events() {
      return this->belongsTo(Event::class);
    }
}

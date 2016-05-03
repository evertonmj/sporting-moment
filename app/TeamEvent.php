<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class TeamEvent extends Model
{
    protected $table = "team_event";

    protected $fillable = ['team_id', 'event_id'];

    public function teams() {
      return $this->belongsTo(Team::class);
    }

    public function events() {
      return $this->belongsTo(Event::class);
    }
}

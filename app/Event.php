<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";

    protected $fillable = ['name', 'description', 'datetime', 'localization', 'latitude_coordinate', 'longitude_coordinate'];

    public function teams() {
      return $this->belongsToMany('app\Team', 'team_event');
    }

    public function users() {
      return $this->belongsToMany('app\User', 'user_event');
    }

    public function moments() {
      return $this->hasMany(Moment::class);
    }
}

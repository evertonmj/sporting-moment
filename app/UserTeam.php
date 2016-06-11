<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
  protected $table = "user_team";

  protected $fillable = ['user_id', 'team_id'];
  //

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function team() {
    return $this->belongsTo(Team::class);
  }
}

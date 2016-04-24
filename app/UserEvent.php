<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $table = "user_event";
    //
    public function user() {
      return $this->belongsTo(User::class);
    }

    public function event() {
      return $this->belongsTo(Event::class);
    }
}

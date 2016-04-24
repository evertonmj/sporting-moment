<?php

namespace Sporting Moment;

use Illuminate\Database\Eloquent\Model;

class UserMoment extends Model
{
    protected $table = "user_moment";
    //

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function moment() {
      return $this->belongsTo(Moment::class);
    }
}

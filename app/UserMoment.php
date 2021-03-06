<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserMoment extends Model
{
    protected $table = "user_moment";

    protected $fillable = ['user_id', 'moment_id'];
    //

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function moment() {
      return $this->belongsTo(Moment::class);
    }
}

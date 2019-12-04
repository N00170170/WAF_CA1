<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }

    public function visits() {
      return $this->hasMany('App\Visit');
    }
}

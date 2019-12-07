<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }

    public function visits() {
      return $this->hasMany('App\Visit');
    }

    public function insurance_company() {
      return $this->belongsTo('App\InsuranceCompany');
    }
}

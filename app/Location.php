<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // fillable fields
    protected $fillable = ['location_short', 'location_long'];

    // Relationships
    public function profiles(){
      return $this->hasMany('App\Profile');
    }
}

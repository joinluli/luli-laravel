<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpType extends Model
{
    // mass assignment fillables
    protected $fillable = ['type'];

    // relationships
    public function experiences(){
      return $this->hasMany('App\Experience');
    }
}

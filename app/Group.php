<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //mass assignment fillables
    protected $fillable = ['title', 'description', 'image_permalink'];

    // Relationships
    public function users(){
      return $this->belongsToMany('App\User');
    }
}

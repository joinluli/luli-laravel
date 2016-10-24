<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Fa model is for "Features In and Achievements"
class Fa extends Model
{
    // fillable fields for mass assignment
    protected $fillable = ['title','description','achievement','user_id', 'image_permalink', 'date'];

    // Relationships
    public function users(){
      return $this->belongsTo('App\User');
    }
}

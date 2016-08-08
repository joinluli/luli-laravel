<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = ['title', 'comment', 'image_permalink', 'user_id'];

    // Relationships
    public function user(){
      return $this->belongsTo('App\User');
    }
}

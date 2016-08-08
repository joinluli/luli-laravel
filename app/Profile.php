<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Fillable fields for protection against mass assignment of everything
    protected $fillable = ['first_name', 'middle_name', 'last_name' ,'industry_name' ,'dp_permalink' ,'about', 'tagline_1', 'tagline_2', 'location', 'user_id'];

    // Relationships
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function location(){
      return $this->belongsTo('App\Location');
    }
}

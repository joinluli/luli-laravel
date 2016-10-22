<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramDetail extends Model
{
    protected $table = 'instagram_details';
    //
    protected $fillable = ['user_id','hashed_access_token', 'instagram_username'];

    // this belongs to one user
    public function user(){
    	return $this->belongsTo('App\User');
    }
}

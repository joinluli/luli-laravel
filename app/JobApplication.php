<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    protected $fillable = ['note', 'viewed', 'job_posting_id', 'user_id'];

    // relationships
    public function job_posting(){
    	return $this->belongsTo('App\JobPosting');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function job_favorites(){
    	return $this->hasMany('App\JobFavorite');
    }
}

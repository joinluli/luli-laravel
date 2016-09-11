<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    //
    protected $fillable = ['job_type'];

    // relationships
    public function job_postings(){
    	return $this->hasMany('App\JobPosting');
    }
}

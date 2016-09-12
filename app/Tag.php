<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['tag'];

    // relationships
    public function job_postings(){
    	return $this->belongsToMany('App\JobPosting');
    }
}

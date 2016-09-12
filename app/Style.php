<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    //
    protected $fillable = ['style'];

    // relationships
    public function job_postings(){
        return $this->hasMany('App\JobPosting');
    }
}

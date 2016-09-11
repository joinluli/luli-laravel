<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = ['name', 'location_id', 'about']

    // relationships

    public function job_postings(){
        return $this->hasMany('App\JobPosting');
    }

}

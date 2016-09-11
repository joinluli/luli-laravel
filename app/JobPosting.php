<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    //
    protected $fillable = ['title', 'about_job', 'start_date', 'end_date','pay', 'website_link', 'about_company', 'location_id', 'job_type_id', 'company_id', 'user_id', 'draft', 'published'];

    // relationships
    public function job_type(){
    	return $this->belongsTo('App\JobType');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function location(){
    	return $this->belongsTo('App\Location');
    }

    public function company(){
    	return $this->belongsTo('App\Company');
    }
}

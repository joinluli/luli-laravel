<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobFavorite extends Model
{
    //
    protected $fillable = ['user_id', 'job_posting_id', 'applied'];

    // relationships
    public function user(){
    	return $this->belongsTo('user');
    }

    public function job_posting(){
    	return $this->belongsTo('job_posting');
    }
}

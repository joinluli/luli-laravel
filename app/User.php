<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships
    public function profile(){
        return $this->hasOne('App\Profile');
    }

    // fas is short of featured in and achievements
    public function fas(){
        return $this->hasMany('App\Fa');
    }

    public function works(){
        return $this->hasMany('App\Work');
    }

    public function job_postings(){
        return $this->hasMany('App\JobPosting');
    }

    public function skills(){
      return $this->belongsToMany('App\Skill')->withPivot('rec_count');
    }

    public function experiences(){
      return $this->hasMany('App\Experience');
    }

    public function groups(){
      return $this->belongsToMany('App\Group');
    }

    public function job_applications(){
        return $this->hasMany('App\JobApplication');
    }

    public function job_favorites(){
        return $this->hasMany('App\JobFavorite');
    }
}

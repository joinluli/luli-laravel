<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    // skip timestamps
    public $timestamps = false;

    protected $fillable =['skill', 'user_id'];

    // Relationships
    public function users(){
      return $this->belongsToMany('App\User')->withPivot('rec_count');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    protected $fillable = ['title','description','place','from_date', 'to_date', 'exp_type_id', 'user_id'];

    // relationships
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function exptype(){
      return $this->belongsTo('App\ExpType');
    }
}

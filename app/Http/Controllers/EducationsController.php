<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Auth;
use Validator;
// include all models
use App\User;
use App\Work;
use App\Experience;
use App\ExpType;
use App\Location;
use App\Profile;
use App\Skill;
use App\Group;
use App\Fa;

class EducationsController extends Controller
{
    //
    public function store(Request $request){
    	$user = Auth::user();
    	$title =  $request['title'];
    	$place =  $request['place'];
    	$from_date = $request['fromdate'];
    	$to_date =  $request['todate'];

    	Experience::create(['title' => $title, 'place' => $place, 'from_date' => $from_date, 'to_date' => $to_date, 'user_id' => $user->id, 'exp_type_id' => 2]);

    	return response()->json(['status' => '1']);
    }
}

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
    // Add a users education into the database
    public function store(Request $request){
    	$user = Auth::user();
    	$title =  $request['title'];
    	$place =  $request['place'];
    	$from_date = $request['fromdate'];
    	$to_date =  $request['todate'];

        // The table name being used here is experiences, as both education and experience is stored in the same table. The exp_type_id defines if its an education or an experiences
    	Experience::create(['title' => $title, 'place' => $place, 'from_date' => $from_date, 'to_date' => $to_date, 'user_id' => $user->id, 'exp_type_id' => 2]);

    	return response()->json(['status' => '1']);
    }

    public function update(Request $request, $id){
        // Get the current user
        $user = Auth::user();
        // update the value for the current key
        $education = Experience::findOrFail($id);
        // the name of the key/ column also arrives from the form
        $name = $request->get('name');
        $value = $request->get('value');
        $education->$name = $value;
        if($education->save()){
            return response()->json(['status' => '1']);
        }
        else{
         return response()->json(['status' => '0']);   
        }

    }
}

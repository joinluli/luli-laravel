<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\User;
use App\Work;
use App\Experience;
use App\ExpType;
use App\Location;
use App\Profile;
use App\Skill;
use App\Group;
use App\Fa;

class ProfilesController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
        //
        $user = Auth::guard('api')->user();
        if (is_null($user->profile)) {
          $pr = $user->profile()->create(Input::all());
          // move uploaded file
          $image = Input::file('dp');
          $filename = md5(microtime() . $image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
          $destination_path = "uploads/";
          Input::file('dp')->move($destination_path, $filename);
          $pr->dp_permalink = "/".$destination_path.$filename;
          $pr->save();
          // Input::merge(array('user_id', $user->id));
          // Profile::create(Input::all());
          return response()->json(['success' => '1']);
        }
        else{
          $a = Input::all();
          return response()->json(['error' => 'Profile already exists']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        $profile = $user->profile;
        $profile['username'] = $user->username;
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update an existing record with new values
        $user = Auth::guard('api')->user();
        $profile = $user->profile;
        $input = $request->all();
        $image = Input::file('dp');
        if ($profile->fill($input)->save()) {
          $pr = $user->profile();
          // move uploaded file
          if(isset($image)){
            $filename = md5(microtime() . $image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
            $destination_path = './uploads/';
            $pr->dp_permalink = "/".$destination_path.$filename;
            $pr->save();
          }
          return response()->json(['success' => '1']);
        }
        else{
          return response()->json(['success' => '0']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Auth::guard('api')->user();
        $profile = $user->profile;
        $profile->delete();
        return response()->json(['success' => '1']);
    }

}

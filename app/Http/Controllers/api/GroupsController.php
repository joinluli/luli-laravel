<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Auth;
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

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        if (Group::create(Input::all())) {
          return response()->json(['success' => '1']);
        }
        else{
          return response()->json(['success' => '0']);
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
        $group = Group::findOrFail($id);
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $user = Auth::guard('api')->user();
        $group = Group::findOrFail($id);
        $input = $request->all();
        if ($group->fill($input)->save()) {
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
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->json(['success' => '1']);
    }

    // When a user joins a group
    public function join_group($group_id){
      // get the current user and join them to the group
      $user = Auth::guard('api')->user();
      $group = Group::findOrFail($id);
      // if the user does not already belong to the same group, join to the group
      if ($user->groups()->where('group_id', $group_id)->count() == 0){
        $user->groups()->attach($group_id);
        return response()->json(['success' => '1']);
      }
      else{
        return response()->json(['success' => '0']);
        }
    }

    // unjoin the user from a group
    public function unjoin_group($group_id){
      // get the current user and unjoin them from the group
      $user = Auth::guard('api')->user();
      $group = Group::findOrFail($id);
      // if the user belongs to the group, and unjoin the, or else, just return an error
      if ($user->groups()->where('group_id', $group_id)->count() != 0){
        $user->groups()->detach($group_id);
        return response()->json(['success' => '1']);
      }
      else{
        return response()->json(['success' => '0']);
        }
    }
}

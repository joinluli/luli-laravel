<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
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

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $user = Auth::guard('api')->user();
        return response()->json($user->skills);
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
        $user = $user = Auth::guard('api')->user();
        // check if skill count is zero, if it is, add this skill into the skills table
        foreach ($request['skills'] as $skill) {
          $data = ['skill' => $skill];
          $saved_skill = Skill::firstOrCreate($data);
          if($user->skills->where('skill', $saved_skill)->count() == 0){
              $user->skills()->attach($saved_skill);
            }
            else{
              // rec_count is recommendation count. if the user already has a skill, increment by 1
              // $user->skills->where('skill', $skill)->first()->pivot->rec_count += 1;

            }

        }
        $users_skill_array = $user->skills;
        // return an array of users skills as json
        return response()->json($users_skill_array);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $user = $user = Auth::guard('api')->user();
        // check if skill count is zero, if it is, add this skill into the skills table
        foreach ($request['skills'] as $skill) {
          $user->skills()->detach($skill);
        }
    }

    public function recommend_skill($skill_id, $user_id){
        $user = User::find($user_id);
        $skill = Skill::find($skill_id)->skill;
        $user_skill_count = $user->skills->where('skill', $skill)->count();

        // check if a skill is already associated with user, AND, if the skill actually exists in the skill table

        if(Skill::where('skill', $skill)->first()) {
            // if a skill is already associated, increment recommendation count by 1
            // lets just use a nested if else here. its easier.
            // and then increment this

            // get the pivot table (the many to many join table)
            $pivot_table = $user->skills->where('skill', 'test2')->first()->pivot;
            $rec_count = $user->skills->where('skill', $skill)->first()->pivot->rec_count + 1;
            $pivot_table->rec_count = $rec_count;
            $pivot_table->save();
            return response()->json(['success' => '1']);
        }
        else{
          // since the skill does not exist in the skills table, it cannot be recommended
            return response()->json(['success' => '0']);
        }
    }

    public function derecommend_skill($skill_id, $user_id){
      $user = User::find($user_id);
      $skill = Skill::find($skill_id)->skill;
      $user_skill_count = $user->skills->where('skill', $skill)->count();

      // check if a skill is already associated with user, AND, if the skill actually exists in the skill table

      if(Skill::where('skill', $skill)->first() ) {

        // get the pivot table (the many to many join table)
        $pivot_table = $user->skills->where('skill', 'test2')->first()->pivot;
        $rec_count = $user->skills->where('skill', $skill)->first()->pivot->rec_count - 1;
        $pivot_table->rec_count = $rec_count;
        $pivot_table->save();

          return response()->json(['success' => '1']);
      }
      else{
        // since the skill does not exist in the skills table, it cannot be derecommended
          return response()->json(['success' => '0']);
      }
    }
}

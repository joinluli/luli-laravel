<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
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

class ExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::guard('api')->user();
        return response()->json($user->experiences);
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
        if (Experience::create(Input::all())) {
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
        $exp = Experience::findOrFail($id);
        return response()->json($exp);
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
        // update an existing record with new values
        $user = Auth::guard('api')->user();
        $exp = Experience::findOrFail($id);
        $input = $request->all();
        if ($exp->fill($input)->save()) {
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
        $exp = Experience::findOrFail($id);
        $exp->delete();
        return response()->json(['success' => '1']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exp_types()
    {
        //
        $exp_types = ExpType::all();
        return response()->json($exp_types);
    }

    /**
     * The next 3 methods will get either experience, freelance, or training.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_experience()
    {
        //
        $user = Auth::guard('api')->user();
        $exp = $user->experiences->where('exp_type_id', 1);
        return response()->json($exp);
    }

    public function get_freelance()
    {
        //
        $user = Auth::guard('api')->user();
        $exp = $user->experiences->where('exp_type_id', 2);
        return response()->json($exp);
    }

    public function get_training()
    {
        //
        $user = Auth::guard('api')->user();
        $exp = $user->experiences->where('exp_type_id', 3);
        return response()->json($exp);
    }

    // the below is a test method
    public function test(Request $request){
      // just a dummy controller
      // $hello = Experience::findOrFail(90);
      $user = Auth::guard('api')->user();
      return response()->json($user);
    }
}

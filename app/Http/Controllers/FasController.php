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

class FasController extends Controller
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
        $user = Auth::user();
        $title =  $request['title'];
        $date =  $request['date'];
        $achievement = $request['achievement'];
        // dd($achievement);
        Fa::create(['title' => $title, 'achievement' => $achievement, 'date' => $date,'user_id' => $user->id]);
        return response()->json(['status' => '1']);
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
        // Get the current user
        $user = Auth::user();
        // update the value for the current key
        $fa = Fa::findOrFail($id);
        // the name of the key/ column also arrives from the form
        $name = $request->get('name');
        $value = $request->get('value');
        $fa->$name = $value;
        if($fa->save()){
            return response()->json(['status' => '1']);
        }
        else{
         return response()->json(['status' => '0']);   
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
        $fa = Fa::find($id);
        if($fa->delete()){
            return response()->json(['status' => '1']);
        }
        else {
            return response()->json(['status' => '0']);
        }
    }
}

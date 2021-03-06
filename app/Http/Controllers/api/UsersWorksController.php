<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Work;
use App\Experience;
use App\ExpType;
use App\Location;
use App\Profile;
use App\Skill;
use App\Group;
use App\Fa;

class UsersWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        //
        $works = $user->works;
        return response()->json($works);
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

        $user = $user = Auth::guard('api')->user();
        $work = new Work;
        // Some processing
        $extension = Input::file('image')->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $fileName = rand(1111111,9999999).'.'.$extension;
        Input::file('image')->move($destinationPath, $fileName);

        $work->image_permalink = '/uploads/'.$fileName."";
        $work->user_id = $user->id;
        $work->title = $request['title'];
        $work->comment = $request['comment'] ?: ""; // the 'comment' field MUST have a value, without which it'll throw errors. This conditional assignment makes sure the field always has some value, even if its not given by the user.
        if($work->save()){
          return response()->json(['success' => "1"]);
        }
        else{
          return response()->json(['success' => "0"]);
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
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Auth;
use Validator;
use App\User;
use App\Work;
use App\Experience;
use App\ExpType;
use App\Location;
use App\Profile;
use App\Skill;
use App\Group;
use App\Fa;
use App\JobPosting;
use App\JobType;
use App\Company;


class JobPostingsController extends Controller
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
        if($request['draft'] == "1"){
            JobPosting::create($request->all());
        }
        else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'start_date' => 'required',
                'location_id' => 'required',
                ]);
            if($validator->fails()){
                return response()->json(['success' => '0', 'errors' => $validator->errors()]);
            }
            JobPosting::create(Input::all());
        }
        return response()->json(['success' => '1']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $jp = JobPosting::find($id);
        // get the currently logged in user
        $user = Auth::guard('api')->user();
        // first check if the job posting $jp exists
        if($jp){
            // If the user who created the job post tries to view it, show it regardless of its published status
            # OR
            // if a user who is not the creator of the posting views it, display only if its published
            if(($user->id == $jp->user_id) || ($jp->published)){
                $message = $jp;
            }
            else{
                $message = "This job posting is not yet published";    
            }
        }
        else{
            $message = "The job posting is invalid or no longer exists";
        }
        return response()->json($message);
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

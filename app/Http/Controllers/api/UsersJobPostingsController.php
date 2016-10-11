<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
use App\Tag;

class UsersJobPostingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        //
        $jps = $user->job_postings;
        return response()->json($jps);
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
    public function store(Request $request, User $user)
    {
        // if the job posting is a draft, do not validate for required fields
        if($request['draft'] == "1"){
            $user->job_postings()->create($request->all());
        }
        //  if it isnt a draft, validate some fields
        else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'start_date' => 'required',
                'location_id' => 'required',
                ]);
            // if validation fails, return errors in the json
            if($validator->fails()){
                return response()->json(['success' => '0', 'errors' => $validator->errors()]);
            }
            // validation passes, and the data is stored with the below command
            $jb = $user->job_postings()->create($request->all());
            // now add tags

        }
        // Either way when a row is created, return success
        return response()->json(['success' => '1']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $job_postings)
    {
        $user_from_api = $user = Auth::guard('api')->user();
        // get the job posting

        try{
            $jp = JobPosting::findOrFail($job_postings);
        }
        catch(ModelNotFoundException $ex){
            return response()->json(['success' => '0', 'errors' => 'The job posting you are trying to update was not found']);
        }
         // If the person who's sending the request IS the logged in person, AND it is this user's job posting, delete it
        if(($user->id == $user_from_api->id) && ($user->id == $jp->user_id)){
            // if the job posting is a draft, do not validate for required fields
            if($request['draft'] == "1"){
                $jp->update($request->all());
            }
            //  if it isnt a draft, validate some fields
            else{
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'start_date' => 'required',
                    'location_id' => 'required',
                    ]);
                // if validation fails, return errors in the json
                if($validator->fails()){
                    return response()->json(['success' => '0', 'errors' => $validator->errors()]);
                }
                // validation passes, and the data is stored with the below command
                $jp->update($request->all());
            }
            // Either way when a row is created, return success
            return response()->json(['success' => '1']);
        }
        else{
            return response()->json(['success' => '0', 'errors' => "You are not authorized to perform this action"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $job_postings)
    {
        $user_from_api = $user = Auth::guard('api')->user();
        // get the job posting

        try{
            $jp = JobPosting::findOrFail($job_postings);
        }
        catch(ModelNotFoundException $ex){
            return response()->json(['success' => '0', 'errors' => 'The job posting you are trying to delete was not found']);
        }
        // If the person who's sending the request IS the logged in person, AND it is this user's job posting, delete it
        if(($user->id == $user_from_api->id) && ($user->id == $jp->user_id)){
            $jp->delete();
            return response()->json(['success' => '1']);
        }
        else{
            return response()->json(['success' => '0', 'errors' => "You are not authorized to perform this action"]);
        }
    }

    // custom method to check if a tag already exists, and add it to the table if it doesn't
    public function store_tags($tag){
        $t = Tag::firstOrCreate(['tag' => $tag]);
        return $t;
    }

    // attach tags
    public function attach_tags(){
        
    }
}

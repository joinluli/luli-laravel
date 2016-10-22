<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Auth;
use Validator;

use App\Http\Controllers\InstagramController;
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

// Instagram functionality inclusions
use Mbarwick83\Instagram\Instagram;
use App\InstagramDetail;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfilesController extends Controller
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
    public function create_1()
    {
        
        // Get a list of cities and euqate them to autocomplete in the view
        $user = Auth::user();
        $cities = Location::all()->pluck('location_long');
        $data['city'] = json_encode($cities);
        if ($user->profile) {
          $data['first_name'] = $user->profile->first_name;
          $data['last_name'] = $user->profile->last_name;
        } 
        else{
          $data['first_name'] = "";
          $data['last_name'] = "";
        }
        return view('profiles.create_1', $data);
    }
    public function create_2()
    {
        //
        return view('profiles.create_2');
    }
    public function create_3()
    {
        //
        return view('profiles.create_3');
    }
    public function create_4()
    {
        //
        return view('profiles.create_4');
    }
    public function create_5()
    {
        //
        return view('profiles.create_5');
    }

    // for folks logging in from social websites, this function displays a page to enter only their username
    public function create_social(){
      $user = Auth::user();
      $data['username'] = $user->username;
      return view('profiles.create_social', $data);
    }

    // store the data from the forms
    public function store_1(Request $request)
    {
        // Get data from post request + declare variables and do some data processing
        $user = Auth::user();
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $tagline_1 = $request['speciality'];
        $city = $request['city'];
        $user_id = Auth::user()->id;
        // get the location id from city
        $location_id = Location::where('location_long', $city)->first()->id;
        // Store data
        if(!($user->onboarded)){
            $profile = Profile::firstOrNew(['first_name' => $first_name, 'last_name' => $last_name, 'tagline_1' => $tagline_1, 'location_id' => $location_id, 'user_id' => $user_id]);
            $profile->save();
            return redirect('/create_profile_2');
            // return $location_id;
        }
        else{
            return "Your profile profile already exists";
        }
    }
    public function store_2(Request $request)
    {
        // Get the three about sections and assemble them into one string
        $about = $request['about_1'].".".$request['about_2'].".".$request['about_3'];
        $user = Auth::user();
        // Check if profile exists, only then add the about section
        if($user->profile){
            // Update the about section of this entry
            $user->profile()->update(['about' => $about]);
            return redirect('/create_profile_3');
        }
        else{
            return back()->withInput();
        }
        
    }

    // This function uploads and saves a users display picture
    public function store_3(Request $request)
    {
        $user = Auth::user();
        // Check if profile exists, only then add the about section
        if($user->profile){
              // move uploaded file
              $image = $request->file('dp');
              $filename = md5(microtime() . $image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
              $destination_path = "uploads/";
              Input::file('dp')->move($destination_path, $filename);
              $dpp = "/".$destination_path.$filename;

              // Update the about section of this entry
              $user->profile->update(['dp_permalink' => $dpp]);
              return redirect('/create_profile_4');
        }
        else{
            return back()->withInput();
        }
        // 
    }

    // The following function uploads a users images of their work and store that in the db
    public function store_4(Request $request)
    {
        $user = Auth::user();
        // Check if profile exists, only then add the about section
        // move uploaded file
          $images = Input::file('images');
          // upload only 9 images
          $counter = 0;
          // lets check if the uploaded file format is actually an image or pdf, if not, just return back
          foreach ($images as $image) {
              $rules = array('file' => 'required|mimes:png,gif,jpeg,pdf'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
              $validator = Validator::make(array('file'=> $image), $rules);
              if($validator->fails()){
                return back()->withErrors($validator);
                }
            }

          foreach ($images as $image) {
                $destination_path = 'uploads/';
                $filename = $image->getClientOriginalName();
                $new_filename = md5(microtime()) . "." . $image->getClientOriginalExtension();
                $image->move($destination_path, $new_filename);
                $dpp = "/".$destination_path.$new_filename;
                Work::create(['image_permalink' => $dpp, 'user_id' => $user->id]);
                $counter++;
            // break out of the foreach after 9 images
              if($counter >= 9){
                break;
              }
          }


          return redirect('/create_profile_5');
    }

    // The following function stores a users work experience in experiences table
    public function store_5(Request $request)
    {
        $user = Auth::user();
        // Add the current users experience. exp_id should be set to '1' for experience and '2' for training.
        $title = $request['title'];
        $place = $request['place'];
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        Experience::create(['title' => $title, 'place' => $place, 'start_date' => $start_date, 'end_date' => $end_date, 'exp_id' => 1, 'user_id' => $user->id]);
        $user->update(['onboarded' => 1]);
        return redirect('my_profile');
    }


    // store the username for social login folks
    public function store_social(Request $request){
      $user = Auth::user();
      $user->update(['username' => str_random(15)]);
      $validator = Validator::make(['username' => $request['username']], ['username' => 'required|unique:users']);
      if($validator->passes()){
        $user->update(['username' => $request['username']]);
        return redirect('create_profile_1');
      }
      else{
        return back()->withErrors($validator);
      }
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

    // Instragram images functionality
    public function instagram_fetch($user_id){
      $instagram = new Instagram;
      $user = User::find($user_id);
      $access_token = decrypt($user->instagram_detail->hashed_access_token);
      $data = $instagram->get('v1/users/self/media/recent/', ['access_token' => $access_token, 'count' => 9]);
      if(isset($data['data'])) {
            return $data['data'];
        }
      else{
        return NULL;
      }
    }

    // Custom written functions
    public function public_profile($username){
      $user = User::where('username', $username)->first();
      $data['profile'] = $user->profile;
      $data['location'] = $user->profile->location;
      $data['fas'] = $user->fas;
      $data['works'] = $user->works;
      $data['experiences'] = $user->experiences->where('exp_type_id', 1);
      $data['freelance'] = $user->experiences->where('exp_type_id', 2);
      $data['training'] = $user->experiences->where('exp_type_id', 3);
      $data['skills'] = $user->skills;
      $data['groups'] = $user->groups;

      return view('profiles.profile', $data);
    }

    // A logged in users profile
    public function my_profile(){
      $user = Auth::user();
      $data['profile'] = $user->profile;
      $data['location'] = $user->profile->location;
      $data['fas'] = $user->fas;
      $data['works'] = $user->works;
      $data['experiences'] = $user->experiences->where('exp_type_id', 1);
      $data['freelance'] = $user->experiences->where('exp_type_id', 2);
      $data['training'] = $user->experiences->where('exp_type_id', 2);
      $data['skills'] = $user->skills;
      $data['groups'] = $user->groups;
      $data['email'] = $user->email;
      $data['username'] = $user->username;
      $data['instagrams'] = $this->instagram_fetch($user->id);

      return view('profiles.my_profile', $data);
    }
}

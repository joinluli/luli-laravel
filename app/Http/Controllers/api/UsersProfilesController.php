<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

class UsersProfilesController extends Controller
{
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        // Show all experiences for this user
        $profiles = $user->profiles;
        return response()->json($profiles);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        //
    }
}

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

class UsersFasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        // Show all experiences for this user
        $fas = $user->fas;
        return response()->json($fas);
    }

 	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {
        // save input to the database and create a new entry

        if ($user->fas()->create(Input::all())) {
          return response()->json(['success' => '1']);
        }
        else{
          return response()->json(['success' => '0']);
        }
    }

}

<?php

namespace App\Http\Controllers\api;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{

    /**
     * A function to perform the login action
     */
    public function login(Request $request)
    {
    	$email = $request['email'];
    	$password = $request['password'];

    	// return response()->json(['id' => $email]);
    	// attempt to login
    	if(Auth::attempt(['email' => $email , 'password' => $password]))
    	{
    		$user = User::where('email', $email)->first();
    		$message = $user->id;

            # generate api token and save it to db
            $api_token = str_random(60);
            $user->api_token = $api_token;
            $user->save();
    	}
    	
        else
    	{
    		$message = NULL;
    	}

    	return response()->json(['id' => $message, 'api_token' => $api_token]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * A function to perform the registration action
     */
    public function register(Request $request)
    {
    	$data['email'] = $request['email'];
        $data['username'] = $request['username'];
    	$data['password'] = $request['password'];
    	$data['password_confirmation'] = $request['password_confirmation'];
        $data['api_token'] = str_random(60);

        // Validate the inputs
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'api_token' => 'unique:users',
        ]);
    	
        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = new User;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->api_token = $data['api_token'];
        $user->username = $data['username'];
        if ($user->save()) {
            return response()->json(['id' => $user->id, 'api_token' => $user->api_token]);
        }

    	
    }
}

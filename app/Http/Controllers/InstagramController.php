<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Mbarwick83\Instagram\Instagram;
use Crypt;
use App\User;
use App\InstagramDetail;

class InstagramController extends Controller
{
    //
    public function insta_login(Instagram $instagram)
	{
	    return redirect($instagram->getLoginUrl());
	    // or Instagram::getLoginUrl();
	}

	// Get access token on callback, once user has authorized via above method
	public function callback(Request $request, Instagram $instagram)
	{
	    $response = $instagram->getAccessToken($request->code);
	    // or $response = Instagram::getAccessToken($request->code);

	    if (isset($response['code']) == 400)
	    {
	        throw new \Exception($response['error_message'], 400);
	    }
	     // dd($request['code']);
	    // return $response['access_token'];
	    // store access token details into the db
	    $user = Auth::user();
	    $encrypted_access_token = Crypt::encrypt($response['access_token']);
	    $user_self =  $instagram->get('v1/users/self/', ['access_token' => $response['access_token']]);
	    $username = $user_self['data']['username'];
	    
	    // add details to instagram_details to table
	    if($user->instagram_detail){
	    	$user->instagram_detail()->update(['instagram_username' => $username, 'hashed_access_token' => $encrypted_access_token]);
	    }
	    else{
	    	InstagramDetail::create(['instagram_username' => $username, 'hashed_access_token' => $encrypted_access_token, 'user_id' => $user->id]);
	    }
	    $data = $instagram->get('v1/users/self/media/recent/', ['access_token' => $response['access_token'], 'count' => 9]);
	    
	    return redirect('my_profile');
	}

	public function get_insta_images(Request $request, Instagram $instagram)
	{
	    $access_token = $response['access_token'];
	    $data = $instagram->get('v1/users/self/media/recent/', ['access_token' => $access_token]);
	    // $data = $instagram->get('v1/users/' $user-id, ['access_token' => $access_token]);
	    return $data;
	}

}

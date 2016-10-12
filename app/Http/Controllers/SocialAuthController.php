<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

	    auth()->login($user);
	    if($user->onboarded){
        	return redirect()->to('/home');
	    }
	    else{
	    	return redirect('create_social');
	    }

    }
}

<?php

namespace App;
use Illuminate\Support\Facades\Log;
// use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)->whereProviderUserId($providerUser->getId())->first();
        // Log::alert(dd($providerUser));
         // dd($providerUser->user['name']['familyName']);
        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $em = $providerUser->getEmail();
                $username =  explode("@", $em)[0];
                $api_token = str_random(60);
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'username' => $username,
                    'api_token' => $api_token,
                ]);
                // The first name and last names from google and facebook are different, so putting a check for that here
                if($providerName == 'GoogleProvider'){
                    $first_name = $providerUser->user['name']['givenName'] ;
                    $last_name = $providerUser->user['name']['familyName'] ;
                }
                else{
                    $first_name = $providerUser->user['first_name'];
                    $last_name = $providerUser->user['last_name'];
                }
                Profile::create(['first_name' => $first_name, 'last_name' => $last_name, 'user_id' => $user->id]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }
    }

}
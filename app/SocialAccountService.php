<?php

namespace App;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')->whereProviderUserId($providerUser->getId())->first();
        // Log::alert(dd($providerUser));
        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
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
                $first_name = $providerUser->user['first_name'];
                $last_name = $providerUser->user['last_name'];
                Profile::create(['first_name' => $first_name, 'last_name' => $last_name, 'user_id' => $user->id]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}
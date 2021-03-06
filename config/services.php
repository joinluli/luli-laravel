<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1333973679976640',
        'client_secret' => '451229cc91c45c069aba6e89dc1835db',
        'redirect' => 'http://app.joinluli.com/callback/facebook',
    ],

    'google' => [
        'client_id' => '822091711427-js0lgfeppr1n2jdv2n63akp1ue1slipl.apps.googleusercontent.com',
        'client_secret' => 'S7skiCNXpYT28w4OafJZN1Gl',
        'redirect' => 'http://app.joinluli.com/callback/google',
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];

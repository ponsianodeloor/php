<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
    'client_id' => '590385855973-9teq4qrgrfhs2gp73qp17bep83hie46t.apps.googleusercontent.com',
    'client_secret' => 'BE6PqipdKp2f-CwMWFIqQPMp',
    'redirect' => 'http://profesor.apptics.com.ec/callback/google',
    ],

    'facebook' => [
    'client_id' => '571560493541721',
    'client_secret' => '1121cf192f017a46ad77eb9a243979af',
    'redirect' => 'http://profesor.apptics.com.ec/auth/facebook/callback'
    ]

];

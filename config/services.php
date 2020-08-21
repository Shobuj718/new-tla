<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'twilio' => [
        'api_key' => 'gZqLjTOLuA2asdfyXjWZyTasdfk1TMjx4DEHsgqp',
         'country_code' => '+88'
        //'country_code' => '+61'
    ],

    'google_maps' => [
        'api_key' => 'AIzaSyBhDZ-X-FmlL7R9vg4VAasdfasdf7843bel7S4GOac',
        /*'api_key' => 'AIzaSyDB075iymW-pSeXwT153dRZ7SSMwkonvV4',*/
    ],

    'square_up_sandbox' => [
        'app_id' => 'sandbox-sq0idb-yl4L00znA_hr4GIeI_cLsQ',
        'access_token' => 'EAAAEPdAVG59Y9aVgNlK46W7_vsD874prC6ofZoOvdTMVvY1wSCF75CpU4skbKIY',
        'location_id' => 'LWRJQF9NK0V74',
        'currency' => 'AUD'
    ],

    

    'stripe_sandbox' => [
        'PUB_KEY' => 'pk_test_51HEBHmCQVwJM1STk4TfL8uQuY0YREMlk7zw7FCr8nm6aeHW6HDKclojfgYcNFSbPcOZLPtQAdP1s4LCDhKl4wFB600XmE7CHDd',
        'SECRET_KEY' => 'sk_test_51HEBHmCQVwJM1STkZHJGNFvYQiw1xt7E9Xegn7Oa6SFsC2KzUmFpBZePtxmyPKwJ8EmR1uRxvlqHv11YYwX0UiXa00NR0QoNKp',
        'currency' => 'AUD'
    ],

    

    'opentok' => [
        'api_key' => '',
        'api_secret' => '',
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '870672448182-asdf.apps.googleusercontent.com',
        'client_secret' => 'asdf',
        'redirect' => 'https://thelawapp.com.au/social-login/google/callback'
    ],

    'facebook' => [
        'client_id' => '10091353asdf92569730',
        'client_secret' => '42f550d5df6sdf7458390e99962afb822d7',
        'redirect' => 'https://thelawapp.com.au/social-login/facebook/callback'
    ],

    'linkedin' => [
        'client_id' => '811jaihjsdfj9os5j',
        'client_secret' => 'Gp0W3OspsdfudsXhcwD',
        'redirect' => 'https://thelawapp.com.au/social-login/linkedin/callback'
    ],

    'twitter' => [
        'client_id' => 'QNCTX4EtrdWEm26lYsdfHnWz8LSZ',
        'client_secret' => 'NKkZVWlJtsdftxDaDfoNe6fmOWGYwaQxzznVUtTY8ssojAoQ90NW7',
        'redirect' => 'https://thelawapp.com.au/social-login/twitter/callback'
    ],
];

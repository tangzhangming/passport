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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'github' => [
        'client_id' => 'Ov23ctFg0cFbB59Y0NsH',
        'client_secret' => env('GITHUB_OAUTH_SECRET'),
        'redirect' => 'https://passport.520.com/web-api/oauth/github/callback',
        'guzzle' => [
            'proxy' => 'http://172.29.128.1:7890',
        ],
    ],

    'google' => [
        'client_id' => '444414227039-rsf7tb1hmaf2ap4fud67qh9arcrnrhev.apps.googleusercontent.com',
        'client_secret' => env('GOOGLE_OAUTH_SECRET'),
        'redirect' => 'https://passport.520.com/web-api/oauth/google/callback',
    ],

    'twitter' => [
        'client_id' => 'TzU3VlQwcDRmYVJ2RVZ2dDJ3c0g6MTpjaQ',
        'client_secret' => env('TWITTER_OAUTH_SECRET'),
        'redirect' => 'https://passport.520.com/web-api/oauth/twitter/callback',
        'guzzle' => [
            'proxy' => 'http://172.29.128.1:7890',
        ],
    ],
];

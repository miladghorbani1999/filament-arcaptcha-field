<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ArCaptcha Site Key
    |--------------------------------------------------------------------------
    |
    | Your ArCaptcha site key. You can get this from https://arcaptcha.ir/dashboard
    |
    */
    'site_key' => env('ARCAPTCHA_SITE_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | ArCaptcha Secret Key
    |--------------------------------------------------------------------------
    |
    | Your ArCaptcha secret key. You can get this from https://arcaptcha.ir/dashboard
    |
    */
    'secret_key' => env('ARCAPTCHA_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | ArCaptcha Options
    |--------------------------------------------------------------------------
    |
    | Default options for ArCaptcha widget
    | Available options: lang, theme, color, etc.
    | See https://docs.arcaptcha.co/ for more information
    |
    */
    'options' => [
        'lang' => 'fa',
        'theme' => 'light',
    ],
];


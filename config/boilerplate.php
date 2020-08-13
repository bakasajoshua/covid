<?php

return [

    // these options are related to the sign-up procedure
    'sign_up' => [

        // this option must be set to true if you want to release a token
        // when your user successfully terminates the sign-in procedure
        'release_token' => env('SIGN_UP_RELEASE_TOKEN', false),

        // here you can specify some validation rules for your sign-in request
        'validation_rules' => [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]
    ],

    // these options are related to the login procedure
    'login' => [

        // here you can specify some validation rules for your login request
        'validation_rules' => [
            'email' => 'required|email',
            'password' => 'required'
        ]
    ],

    // these options are related to the password recovery procedure
    'forgot_password' => [

        // here you can specify some validation rules for your password recovery procedure
        'validation_rules' => [
            'email' => 'required|email'
        ]
    ],

    // these options are related to the password recovery procedure
    'reset_password' => [

        // this option must be set to true if you want to release a token
        // when your user successfully terminates the password reset procedure
        'release_token' => env('PASSWORD_RESET_RELEASE_TOKEN', false),

        // here you can specify some validation rules for your password recovery procedure
        'validation_rules' => [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]
    ],

    'credential_request' => [
        'validation_rules' => [
            'email' => ['required', 'email', 'max:80'],            
            'name' => ['required', 'max:100',],            
            'organisation' => ['required', 'max:100',],            
            'phone_number' => ['nullable', 'max:20',],            
            'details' => ['required', 'max:255',],            
        ],
    ],


    'covid_sample' => [
        'identifier' => ['required', 'string'],
        'patient_name' => ['required', 'string'],
        'county' => ['required', 'string'],
        'age' => ['required', 'integer'], 
        'sex' => ['required', 'string', 'in:m,f,M,F'],
        'datecollected' => ['required', 'before_or_equal:today', 'date_format:Y-m-d'],
    ],

];

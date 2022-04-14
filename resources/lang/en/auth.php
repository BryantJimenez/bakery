<?php

return [
    'login' => [
        'title' => 'Sign In',
        'button' => 'Login',
        'password' => [
            'text' => 'Forgot your password?',
            'button' => 'Recover'
        ],
        'register' => [
            'text' => 'You do not have an account?',
            'button' => 'Sign up'
        ]
    ],

    'register' => [
        'title' => 'User Registration',
        'button' => 'Sign Up',
        'terms' => [
            'text' => 'I agree',
            'button' => 'terms and conditions'
        ],
        'login' => [
            'text' => 'Do you already have an account?',
            'button' => 'Sign in'
        ],
        'modal' => [
            'title' => 'Terms and Conditions'
        ]
    ],

    'email' => [
        'title' => 'Recover Password',
        'button' => 'Send',
        'register' => [
            'text' => 'You do not have an account?',
            'button' => 'Sign up'
        ]
    ],

    'reset' => [
        'title' => 'Reset Password',
        'button' => 'Send',
        'login' => [
            'text' => 'Do you already have an account?',
            'button' => 'Sign in'
        ]
    ],

    'notifications' => [
        'login' => [
            'error' => [
                'title' => 'Entry not allowed',
                'msg' => 'This user is not allowed to login.',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

];

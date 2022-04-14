<?php

return [
    'exceptions' => [
        '401' => 'Not authenticated.',
        '403' => 'Forbidden.',
        '404' => 'No results found.',
        '405' => 'The method specified in the request is not valid.',
        '422' => 'The data sent was not valid.'
    ],

	'400' => [
        'title' => 'Error 400',
        'number' => '400',
        'subtitle' => 'Error loading page!',
        'text' => 'Please try again later!',
        'button' => 'Home'
    ],

    '403' => [
        'title' => 'Error 403',
        'number' => '403',
        'subtitle' => 'Prohibition Error!',
        'text' => 'You do not have permission to access this site!',
        'button' => 'Home'
    ],

    '404' => [
        'title' => 'Error 404',
        'number' => '404',
        'subtitle' => 'Page not found!',
        'text' => 'What you are looking for you will not find it here!',
        'button' => 'Home'
    ],

    '419' => [
        'title' => 'Error 419',
        'number' => '419',
        'subtitle' => 'Session expired!',
        'text' => 'Your session has expired!',
        'button' => 'Home'
    ],

    '500' => [
        'title' => 'Error 500',
        'number' => '500',
        'subtitle' => 'Internal server error!',
        'text' => 'Please try again later!',
        'button' => 'Home'
    ],

    '503' => [
        'title' => 'Error 503',
        'number' => '503',
        'subtitle' => 'This site will load in a few minutes!',
        'text' => 'Please try again later!',
        'button' => 'Home'
    ]
];

?>
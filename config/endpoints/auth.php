<?php

return [
    [
        'path'   => '/login',
        'method' => 'showLoginForm',
        'type'   => 'get',
        'name'   => 'login',
        'middleware' => ['web', 'guest'],
    ],
    [
        'path'   => '/login',
        'method' => 'login',
        'type'   => 'post',
        'name'   => 'login',
        'middleware' => ['web', 'guest'],
    ],
    [
        'path'   => '/logout',
        'method' => 'logout',
        'type'   => 'get',
        'name'   => 'logout',
        'middleware' => ['web'],
    ],
    // [
    //     'path'   => '/register',
    //     'method' => 'showRegistrationForm',
    //     'type'   => 'get',
    //     'name'   => 'register',
    //     'middleware' => ['web', 'guest'],
    // ],
    // [
    //     'path'   => '/register',
    //     'method' => 'register',
    //     'type'   => 'post',
    //     'name'   => 'register',
    //     'middleware' => ['web', 'guest'],
    // ],
];

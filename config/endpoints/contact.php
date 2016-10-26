<?php

return [
    [
        'path'   => '/',
        'method' => 'index',
        'type'   => 'get',
        'name'   => 'contact',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/submit',
        'method' => 'submit',
        'type'   => 'post',
        'name'   => 'contact-submit',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/thank-you',
        'method' => 'thankYou',
        'type'   => 'get',
        'name'   => 'contact-thank-you',
        'middleware' => ['web'],
    ],
];

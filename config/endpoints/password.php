<?php

return [
    [
        'path'   => '/email',
        'method' => 'sendResetLinkEmail',
        'type'   => 'post',
        'name'   => 'reset_email',
        'middleware' => ['web', 'guest'],
    ],
    [
        'path'   => '/reset',
        'method' => 'reset',
        'type'   => 'post',
        'name'   => 'reset_password',
        'middleware' => ['web', 'guest'],
    ],
    [
        'path'   => '/reset/{token?}',
        'method' => 'showResetForm',
        'type'   => 'get',
        'name'   => 'reset_password',
        'middleware' => ['web', 'guest'],
    ],
];

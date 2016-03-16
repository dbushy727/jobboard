<?php

return [
    [
        'path'   => '/',
        'method' => 'index',
        'type'   => 'get',
        'name'   => 'jobs',
    ],
    [
        'path'   => '/create',
        'method' => 'create',
        'type'   => 'get',
        'name'   => 'create_jobs'
    ],
    [
        'path'   => '/pending',
        'method' => 'pending',
        'type'   => 'get',
        'name'   => 'pending_jobs',
        'middleware' => 'auth',
    ],
    [
        'path'   => '/{id}',
        'method' => 'show',
        'type'   => 'get',
        'name'   => 'job',
    ],
    [
        'path'   => '/{id}/preview',
        'method' => 'preview',
        'type'   => 'get',
        'name'   => 'preview_job',
    ],
    [
        'path'   => '/',
        'method' => 'store',
        'type'   => 'post',
        'name'   => 'store_job',
    ],
    [
        'path'   => '/{id}/activate',
        'method' => 'activate',
        'type'   => 'post',
        'name'   => 'activate_job',
    ],

];

<?php

return [
    [
        'path'   => '/',
        'method' => 'index',
        'type'   => 'get',
        'name'   => 'jobs',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/create',
        'method' => 'create',
        'type'   => 'get',
        'name'   => 'create_job',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/pending',
        'method' => 'pending',
        'type'   => 'get',
        'name'   => 'pending_jobs',
        'middleware' => ['web', 'auth'],
    ],
    [
        'path'   => '/feed',
        'method' => 'feed',
        'type'   => 'get',
        'name'   => 'feed',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/search',
        'method' => 'search',
        'type'   => 'get',
        'name'   => 'search',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/{id}',
        'method' => 'show',
        'type'   => 'get',
        'name'   => 'show_job',
        'middleware' => ['web', 'job_exists', 'active'],
    ],
    [
        'path'   => '/{id}/preview',
        'method' => 'preview',
        'type'   => 'get',
        'name'   => 'preview_job',
        'middleware' => ['web', 'job_exists', 'verify_session', 'inactive'],
    ],
    [
        'path'   => '/',
        'method' => 'store',
        'type'   => 'post',
        'name'   => 'store_job',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/{id}/activate',
        'method' => 'activate',
        'type'   => 'post',
        'name'   => 'activate_job',
        'middleware' => ['web', 'auth', 'job_exists', 'inactive'],
    ],
    [
        'path'   => '/{id}/payment',
        'method' => 'payment',
        'type'   => 'post',
        'name'   => 'pay_for_job',
        'middleware' => ['web', 'job_exists'],
    ],
    [
        'path'   => '/{id}/edit/{token}',
        'method' => 'edit',
        'type'   => 'get',
        'name'   => 'edit_job',
        'middleware' => ['web', 'job_exists', 'valid_token'],
    ],
    [
        'path'   => '/{id}/update',
        'method' => 'update',
        'type'   => 'post',
        'name'   => 'update_job',
        'middleware' => ['web', 'job_exists'],
    ],
    [
        'path'   => '/{id}/info',
        'method' => 'info',
        'type'   => 'get',
        'name'   => 'info_job',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/{id}/reject',
        'method' => 'reject',
        'type'   => 'post',
        'name'   => 'reject_job',
        'middleware' => ['web', 'auth', 'job_exists'],
    ],
    [
        'path'   => '/{id}/approval',
        'method' => 'approval',
        'type'   => 'get',
        'name'   => 'approve_job',
        'middleware' => ['web', 'auth', 'job_exists', 'inactive'],
    ],
];

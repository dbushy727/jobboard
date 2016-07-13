<?php

return [
    [
        'path'   => '/{id}',
        'method' => 'show',
        'type'   => 'get',
        'name'   => 'info_job',
        'middleware' => ['web'],
    ],
    [
        'path'   => '/{id}/apply-coupon',
        'method' => 'applyCoupon',
        'type'   => 'post',
        'name'   => 'apply_coupon',
        'middleware' => ['web'],
    ],
];

<?php

$endpoints = array_except(config('endpoints'), 'endpoints');

foreach ($endpoints as $endpoint_group => $endpoint) {
    $controller = config("endpoints.endpoints.{$endpoint_group}");
    $type       = array_get($endpoint, 'type');
    $path       = array_get($endpoint, 'path');
    $method     = array_get($endpoint, 'method');
    $name       = array_get($endpoint, 'name');
    $middleware = array_get($endpoint, 'middleware');

    $full_path = "/{$endpoint_group}{$path}";

    $params = [
        'uses' => "{$controller}@{$method}",
        'as' => $name,
        'middleware' => $middleware,
    ];

    $params = array_filter($params);

    app('Illuminate\Routing\Router')->$type("{$full_path}", $params);
}

Route::get('/', function () {
    return redirect('/jobs');
});

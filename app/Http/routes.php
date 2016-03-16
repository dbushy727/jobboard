<?php

$endpoints = array_except(config('endpoints'), 'endpoints');
foreach ($endpoints as $base => $endpoint_group) {
    foreach ($endpoint_group as $endpoint) {

        $controller = config("endpoints.endpoints.{$base}");
        $type       = array_get($endpoint, 'type');
        $path       = array_get($endpoint, 'path');
        $method     = array_get($endpoint, 'method');
        $name       = array_get($endpoint, 'name');
        $middleware = array_get($endpoint, 'middleware');

        $full_path = "/{$base}{$path}";

        $params = [
            'uses' => "{$controller}@{$method}",
            'as' => $name,
            'middleware' => $middleware,
        ];

        $params = array_filter($params);

        app('Illuminate\Routing\Router')->$type("{$full_path}", $params);
    }
}

Route::get('/', function () {
    return redirect('/jobs');
});

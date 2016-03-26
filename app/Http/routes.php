<?php

// usage inside a laravel route
Route::get('/danny', function () {
    $img = \Image::make('foo.jpg')->resize(300, 200);

    return $img->response('jpg');
});

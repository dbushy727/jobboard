<?php

Route::get('/', function () {
    return redirect('/jobs');
});

// Job Routes
Route::get('/jobs', 'JobController@index');
Route::get('/jobs/create', 'JobController@create');
Route::get('/jobs/{id}', 'JobController@show');
Route::get('/jobs/{id}/preview', 'JobController@preview');


Route::post('/jobs', 'JobController@store');
Route::post('/jobs/{id}/activate', 'JobController@activate');

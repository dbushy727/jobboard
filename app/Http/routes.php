<?php

use App\Models\Job;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return redirect('/jobs');
});

// Job Routes
$app->get('/jobs', 'JobController@index');
$app->get('/jobs/create', 'JobController@create');
$app->get('/jobs/{id}', 'JobController@show');
$app->get('/jobs/{id}/preview', 'JobController@preview');


$app->post('/jobs', 'JobController@store');
$app->post('/jobs/{id}/activate', 'JobController@activate');

<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Job::class, function (Faker\Generator $faker) {
    return [
        'application_method' => $faker->sentence(),
        'company_name'       => $faker->words(2, true),
        'description'        => $faker->paragraph(),
        'edit_token'         => str_random(40),
        'email'              => $faker->safeEmail(),
        'is_active'          => false,
        'is_featured'        => false,
        'is_paid'            => false,
        'is_remote'          => false,
        'is_rejected'        => false,
        'location'           => $faker->city(),
        'logo'               => null,
        'price'              => 20000,
        'session_token'      => str_random(40),
        'title'              => $faker->words(3, true),
        'url'                => $faker->url(),
    ];
});

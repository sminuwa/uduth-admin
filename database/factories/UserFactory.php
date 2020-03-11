<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => 'sminuwa',
        'password' => bcrypt('123456'), // password
        'fullname' => 'Sunusi Mohd Inuwa',
        'dob' => '01-01-1991',
        'gender' => 'Male',
        'email' => 'sminuwa@yahoo.com',
        'phone' => '08135067070',
        'remember_token' => Str::random(10),
    ];
});

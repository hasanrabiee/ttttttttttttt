<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        'FirstName' => $faker->firstName,
        'LastName' => $faker->lastName,
        'Username' => $faker->userName,
        'PhoneNumber' => '11111111111111111',
        'Rule' => 'Visitor',
        'City' => $faker->city,
        'Country' => $faker->country,
        'Gender' => 'Male',
        'Image' => 'assets/img/NoPic.png',
        'email_verified_at' => \Carbon\Carbon::now(),
        'email' => $faker->email,
        'password' => Hash::make('1234@qwe'),
    ];
});

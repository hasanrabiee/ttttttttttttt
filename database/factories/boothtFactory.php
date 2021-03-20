<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\booth;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


$factory->define(booth::class, function (Faker $faker) {



    $name = substr($faker->name, 0, 9);
    return [
        'HeaderName' => $name,
        'HeaderColor' => $faker->hexcolor,
        'Color1' => $faker->hexcolor,
        'Color2' => $faker->hexcolor,
        'Type' => 'A',
        'Logo' => $faker->imageUrl(),
        'Poster1' => $faker->imageUrl(),
        'Poster2' => $faker->imageUrl(),
        'Poster3' => $faker->imageUrl(),
        'Video' => $faker->imageUrl(),

        'Hall' => 1,
        'WebSiteColor' => $faker->hexcolor,
        'Representative' => $name,
        'CompanyName' => $name,
        'Description' => $faker->text,
        'Status' => 'Active',
        'Position' => 1,
        'UserID' => 1
    ];
});

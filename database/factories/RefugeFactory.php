<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Refuge;
use Faker\Generator as Faker;

$factory->define(Refuge::class, function (Faker $faker) {
    return [
        'name' => 'nameRefuge',
        'description' => 'refuge description',
        'lat' => '2.5565',
        'lng' => '2.45336',

    ];
});

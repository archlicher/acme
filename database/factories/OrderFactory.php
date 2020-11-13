<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'orderNumber' => $faker->randomDigitNotNull,
        'customerName' => $faker->name,
        'owner' => $faker->name,
        'orderStatus' => 'new'
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'body' => $faker->text(),
        // 'img_name' => $faker->sentence(5),
        'created_by' => 4,
        'status' => 'NEW',
        'isActive' => 1,
    ];
});

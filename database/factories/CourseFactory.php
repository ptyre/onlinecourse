<?php

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "slug" => $faker->name,
        "description" => $faker->name,
        "price" => $faker->randomNumber(2),
        "start_date" => $faker->date("Y-m-d", $max = 'now'),
        "published" => 0,
    ];
});

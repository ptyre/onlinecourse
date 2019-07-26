<?php

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        "question" => $faker->name,
        "score" => $faker->randomNumber(2),
    ];
});

<?php

$factory->define(App\QuestionOption::class, function (Faker\Generator $faker) {
    return [
        "question_id" => factory('App\Question')->create(),
        "option_text" => $faker->name,
        "correct" => 0,
    ];
});

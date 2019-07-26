<?php

$factory->define(App\Test::class, function (Faker\Generator $faker) {
    return [
        "course_id" => factory('App\Course')->create(),
        "lesson_id" => factory('App\Lesson')->create(),
        "title" => $faker->name,
        "description" => $faker->name,
        "published" => 0,
    ];
});

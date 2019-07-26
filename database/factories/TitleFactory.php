<?php

$factory->define(App\Title::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "type" => collect(["index","news","contact","teacher",])->random(),
        "show" => 0,
    ];
});

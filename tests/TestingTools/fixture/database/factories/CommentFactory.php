<?php

$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->sentence,
    ];
});

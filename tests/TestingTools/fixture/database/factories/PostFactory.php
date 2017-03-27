<?php

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'publish_date' => $faker->dateTimeThisYear,
    ];
});

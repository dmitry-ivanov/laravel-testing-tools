<?php

use Illuminated\Testing\Tests\App\Comment;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->sentence,
    ];
});

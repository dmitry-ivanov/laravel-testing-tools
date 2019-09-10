<?php

use Illuminated\TestingTools\Tests\Fixture\App\Comment;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->sentence,
    ];
});

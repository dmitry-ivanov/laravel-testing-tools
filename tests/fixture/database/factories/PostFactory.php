<?php

use Illuminated\TestingTools\Tests\Fixture\App\Post;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'publish_at' => $faker->dateTimeThisYear,
    ];
});

<?php

namespace Illuminated\Testing\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminated\Testing\Tests\App\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'publish_at' => $this->faker->dateTimeThisYear,
        ];
    }
}

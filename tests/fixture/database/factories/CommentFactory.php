<?php

namespace Illuminated\Testing\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminated\Testing\Tests\App\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence,
        ];
    }
}

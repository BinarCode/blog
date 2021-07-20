<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'content' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug,
            'tags' => [
                [
                    'name' => $this->faker->word,
                    'type' => 'text',
                    'value' => $this->faker->word
                ]
            ],
            'user_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}

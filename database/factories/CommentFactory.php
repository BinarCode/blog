<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'blog_id' => Blog::query()->inRandomOrder()->first()->id,
            'body' => $this->faker->sentence,
        ];
    }
}

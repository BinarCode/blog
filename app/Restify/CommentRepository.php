<?php

namespace App\Restify;

use App\Models\Comment;
use Binaryk\LaravelRestify\Fields\BelongsTo;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class CommentRepository extends Repository
{
    public static $model = Comment::class;

    public static array $search = [
        'body',
    ];


    public static function related(): array
    {
        return [
          'creator' => BelongsTo::make('creator', UserRepository::class),
          'blog' => BelongsTo::make('blog', BlogRepository::class),
        ];
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            field('user_id')->storingRules('required'),
            field('blog_id')->storingRules('required'),
            field('body')->storingRules('required'),
        ];
    }
}

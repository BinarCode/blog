<?php

namespace App\Restify;

use App\Models\Blog;
use Binaryk\LaravelRestify\Fields\BelongsTo;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Fields\Image;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class BlogRepository extends Repository
{
    public static $model = Blog::class;

    public static array $search = [
        'title',
        'content',
    ];

    public static array $sort = [
        'views',
    ];

    public static function related(): array
    {
        return [
            'creator' => BelongsTo::make('creator', UserRepository::class),
            'comments' => HasMany::make('comments', CommentRepository::class),
        ];
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            field('title')->storingRules('required'),
            field('content'),
            field('tags'),
            Image::make('image'),
            field('slug')->readonly(),
            field('views')->readonly(),
            field('created_at')->readonly(),
        ];
    }
}

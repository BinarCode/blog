<?php

namespace App\Restify;

use App\Models\User;
use App\Restify\Actions\ChangePasswordAction;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Fields\Image;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class UserRepository extends Repository
{
    public static $model = User::class;

    public static function related(): array
    {
        return [
            'blogs' => HasMany::make('blogs', BlogRepository::class),
            'comments' => HasMany::make('comments', CommentRepository::class),
            'media' => HasMany::make('media', MediaRepository::class),
        ];
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            field('first_name'),
            field('last_name'),
            field('email'),
            Image::make('avatar'),

            field('email')->storingRules('required', 'unique:users'),
        ];
    }

    public function actions(RestifyRequest $request): array
    {
        return [
          ChangePasswordAction::new()->standalone(),
        ];
    }
}

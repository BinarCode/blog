<?php

namespace App\Restify;

use App\Models\User;
use App\Restify\Actions\ChangePasswordAction;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Fields\Image;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Laravolt\Avatar\Facade as Avatar;

class UserRepository extends Repository
{
    public static string $model = User::class;

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
            field('first_name')->storingRules('required'),
            field('last_name')->storingRules('required'),
            field('email'),
            field('name'),
            Image::make('avatar')->disk('public')->default(
                Avatar::create($this->model()->name)->setFontFamily('Poppins')->toBase64(),
            ),

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

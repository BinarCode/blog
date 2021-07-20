<?php

namespace App\Restify;

use App\Models\User;
use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Fields\Image;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    public static $model = User::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            field('first_name'),
            field('last_name'),
            field('email'),
            Image::make('avatar'),

            field('email')->storingRules('required', 'unique:users'),

            field::make('password')
                ->value(fn (Request $request) => Hash::make($request->input('password')))
                ->storingRules('required')
                ->storingRules('confirmed')
                ->hidden(),
        ];
    }
}

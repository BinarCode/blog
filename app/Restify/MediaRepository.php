<?php

namespace App\Restify;

use App\Models\Media;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class MediaRepository extends Repository
{
    public static $model = Media::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            field('file_name'),
            field('name'),
            field('mime_type'),
            field('path'),
            field('human_readable_size'),
        ];
    }
}

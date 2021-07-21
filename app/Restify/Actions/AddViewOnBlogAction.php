<?php

namespace App\Restify\Actions;

use App\Models\Blog;
use Binaryk\LaravelRestify\Actions\Action;
use Binaryk\LaravelRestify\Http\Requests\ActionRequest;
use Illuminate\Http\JsonResponse;

class AddViewOnBlogAction extends Action
{
    public static $uriKey = 'add-view-blog';

    public function handle(ActionRequest $request, Blog $blog): JsonResponse
    {
       $blog->addViews();

       return data($blog);
    }
}

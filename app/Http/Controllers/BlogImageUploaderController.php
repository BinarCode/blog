<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogImageUploaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'picture' => 'required|image',
        ]);

        /**
         * @var User $user
         */
        $user = Auth::user();

        $blogImage = $user->addMediaFromRequest('picture')->preservingOriginal()->toMediaCollection('blogPictures');

        return response()->json(['data' => $blogImage], 200);
    }
}

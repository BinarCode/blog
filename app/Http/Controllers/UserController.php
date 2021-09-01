<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->deleteAvatar();

        return data($user);
    }
}

<?php

namespace App\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Binaryk\LaravelRestify\Http\Requests\ActionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction extends Action
{
    public static $uriKey = 'change-password';

    public function handle(ActionRequest $request): JsonResponse
    {
        $request->validate($this->payload());

        $user = Auth::user();
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        $request->validate($this->payload());

        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();

            return data($user);
        }

        return response()->json(['error' => 'Invalid credentials'], 400);
    }

    public function payload(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ];
    }
}

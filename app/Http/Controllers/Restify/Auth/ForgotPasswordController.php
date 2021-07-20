<?php

namespace App\Http\Controllers\Restify\Auth;

use App\Mail\Restify\Auth\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        /** * @var User $user */

        $user = User::query()->where($request->only('email'))->firstOrFail();

        $token = Password::createToken($user);

        $url = str_replace(
            ['{token}', '{email}'],
            [$token, $user->email],
            config('restify.auth.password_reset_url')
        );

        Mail::to($user->email)->send(
            new ForgotPasswordMail($url)
        );

        return data(__('Email sent.'));
    }
}

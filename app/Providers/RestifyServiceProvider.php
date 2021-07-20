<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Binaryk\LaravelRestify\RestifyApplicationServiceProvider;
use App\Http\Controllers\Restify\Auth\RegisterController;
use App\Http\Controllers\Restify\Auth\ForgotPasswordController;
use App\Http\Controllers\Restify\Auth\LoginController;
use App\Http\Controllers\Restify\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Restify\Auth\VerifyController;

class RestifyServiceProvider extends RestifyApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function gate(): void
    {
        Gate::define('viewRestify', function ($user) {
            return true;
        });
    }

    public function register()
    {
        Route::post('register', RegisterController::class)
            ->name('restify.register');

        Route::post('login', LoginController::class)
            ->middleware('throttle:6,1')
            ->name('restify.login');

        Route::post('verify/{id}/{hash}', VerifyController::class)
            ->middleware('throttle:6,1')
            ->name('restify.verify');

        Route::post('forgotPassword', ForgotPasswordController::class)
            ->middleware('throttle:6,1')
            ->name('restify.forgotPassword');

        Route::post('resetPassword', ResetPasswordController::class)
            ->middleware('throttle:6,1')
            ->name('restify.resetPassword');
    }
}

<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogImageUploaderController;
use App\Http\Controllers\Restify\Auth\ForgotPasswordController;
use App\Http\Controllers\Restify\Auth\LoginController;
use App\Http\Controllers\Restify\Auth\RegisterController;
use App\Http\Controllers\Restify\Auth\ResetPasswordController;
use App\Http\Controllers\Restify\Auth\VerifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::restifyAuth();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::post('blog/image', BlogImageUploaderController::class)->name('blog.image');
Route::get('blogs', [BlogController::class,  'getBlogs'])->name('blogs');
Route::post('blogs/{id}/view', [BlogController::class,  'addViews'])->name('blog.views');

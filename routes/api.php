<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/api/posts/{post}', function (Post $post) {
//     return $post->toResource();
// });

// posts routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    // protected routes go here
    Route::get('/user/profile', UserController::class);
    Route::post('/logout', LogoutController::class);
});

Route::post('/auth/register', RegisterController::class);
Route::post('/auth/login', LoginController::class);

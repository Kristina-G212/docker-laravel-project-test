<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', RegisterController::class)->name('api.register');
    Route::post('/login', LoginController::class)->name('api.login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/user/profile', UserController::class)->name('api.profile');
    Route::post('/logout', LogoutController::class)->name('api.logout');
});

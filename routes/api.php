<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/user/profile/{id}', function (string $id) {
        return new UserResource(User::findOrFail($id));
    })->name('profile');
    Route::post('/logout', LogoutController::class)->name('logout');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json([
        'message' => 'verified',
    ]);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Ссылка для повторной отправки письма
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json([
        'message' => 'resend',
    ]);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

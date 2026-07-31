<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\UpdateUserDataController;
use App\Http\Controllers\Auth\UpdateUserPasswordController;
use App\Http\Controllers\Get\GetAuthorBookController;
use App\Http\Controllers\Get\GetBookController;
use App\Http\Controllers\Get\GetBookGenreController;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
  Route::post('/auth/register', RegisterController::class);
  Route::post('/auth/login', LoginController::class);
  Route::post('/auth/code', TwoFactorController::class);

  Route::get('/books', GetBookController::class);
  Route::get('/authors', GetAuthorBookController::class);
  Route::get('/genres', GetBookGenreController::class);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
  Route::get('/user/profile', function (Request $request) {
    return new UserResource($request->user());
  });
  Route::put('/user/profile', UpdateUserDataController::class);
  Route::put('/user/profile/password', UpdateUserPasswordController::class);
  Route::post('/logout', LogoutController::class);
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
    'message' => 'Verification link sent',
  ]);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');


<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function () {
    Route::view('/', 'preview')->name('preview');
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/login', 'auth.login')->name('login');
});

Route::post('/register', RegisterController::class)->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/profile', UserController::class)->name('profile');
    Route::post('/logout', LogoutController::class)->name('logout');
});

// Подтверждение почты
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Ссылка для повторной отправки письма
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

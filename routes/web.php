<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\AuthenticateSession;

Route::view('/', 'preview')
    ->name('preview');

// Register routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', RegisterController::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login'); // эта штука в шаблоне Blade дает возможость ссылаться на этот маршрут через {{ route('login') }}, а не прописывать URL вручную (/login, он мог лежать где угодно)

Route::post('/login', LoginController::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

/*
// Invalidating Sessions on Other Devices, но пока мне не понятно как это юзать
Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', function () {
        // ...
    });
});
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/', function () {
    //     // Uses first & second middleware...
    // });
 
    Route::get('/user/profile', UserController::class)->name('profile');
        
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

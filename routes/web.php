<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::view('/', 'preview')->name('preview');
    Route::view('/register', 'auth.register')->name('view.register');
    Route::view('/login', 'auth.login')->name('view.login');
});

// Подтверждение почты
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
  Route::view('/', 'preview')->name('preview');
  Route::get('/book/{id}', function (string $id) {
    return view('book', ['id' => $id]);
  })->name('current-book');
  Route::view('/register', 'auth.register')->name('register');
  Route::view('/login', 'auth.login')->name('login');
  Route::view('/login/2fa', 'auth.two-factor');
});


Route::view('/user/profile', 'user.profile')->name('profile');
Route::view('/user/favorites', 'user.favorites')->name('favorites');
Route::view('/user/comments', 'user.comments')->name('comments');

Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
Route::view('/email/verify/{id}/{hash}', 'auth.verify-email')->name('web.verification.verify');

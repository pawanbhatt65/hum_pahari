<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'middleware' => ['auth', 'verified', 'role:user']], function () {
    Route::get('/dashboard', function () {
        return view('pages.logged_user.dashboard');
    })->name('user.dashboard');

    Route::resource('/register-homestay/', UserController::class);
});

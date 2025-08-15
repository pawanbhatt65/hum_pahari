<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('pages.logged_user.dashboard');
    })->name('user.dashboard');
});

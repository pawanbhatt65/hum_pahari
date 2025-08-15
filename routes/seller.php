<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', function () {
        return view('pages.logged_seller.dashboard');
    })->name('seller.dashboard');
});

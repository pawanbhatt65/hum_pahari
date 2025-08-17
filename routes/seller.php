<?php

use App\Http\Controllers\Seller\HomeStayeController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'verified', 'role:seller']], function () {
    Route::get('/dashboard', [SellerController::class, 'getDashboard'])->name('seller.dashboard');
    Route::resource('/homestays', HomeStayeController::class);
});

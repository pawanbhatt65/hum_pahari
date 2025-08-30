<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\HomeStayeController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'verified', 'role:seller']], function () {
    Route::get('/dashboard', [SellerController::class, 'getDashboard'])->name('seller.dashboard');
    // home stay list data route
    Route::get('/homestays/home-stay-list', [HomeStayeController::class, 'homeStayList'])->name('homestays.homeStayList');
    Route::put('/homestays/{id}/approve', [HomeStayeController::class, 'updateApproval'])->name('homestays.approve');
    Route::get('/homestays/{id}/benefits', [HomeStayeController::class, 'benefits'])->name('homestays.benefits');
    Route::get('/homestays/{id}/benefit/edit/{benefit_id}', [HomeController::class, 'getEditBenefit'])->name('homestays.getEditBenefit');
    Route::put('/homestays/{id}/benefit/edit/{benefit_id}', [HomeController::class, 'putEditBenefit'])->name('homestays.putEditBenefit');
    Route::delete('/homestays/{id}/benefit/delete/{benefit_id}', [HomeController::class, 'deleteBenefit'])->name('homestays.deleteBenefit');
    Route::resource('/homestays', HomeStayeController::class);
});

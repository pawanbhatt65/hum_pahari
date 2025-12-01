<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'postAdminLogin'])->name('admin.login.post');

Route::group(['prefix' => '/admin', 'middleware' => ['auth.admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/sellers', [AdminController::class, 'registeredSeller'])->name('registered-seller.index');
    Route::get('/sellers/list', [AdminController::class, 'sellersList'])->name('registered-seller.list');
    Route::get('/sellers/show/{id}', [AdminController::class, 'sellerShow'])->name('admin.sellers.show');
    Route::get('/sellers/show/{id}/list', [AdminController::class, 'sellerShowList'])->name('admin.sellers.show_list');
    Route::delete('/sellers/delete/{id}', [AdminController::class, 'sellerDelete'])->name('admin.sellers.delete');
    Route::get('/sellers/{seller_id}/homestay/{homestay_id}', [AdminController::class, 'sellerShowHomeStay'])->name('admin.homestay.show');
    Route::delete('/sellers/{seller_id}/homestay/{homestay_id}', [AdminController::class, 'sellerDeleteHomeStay'])->name('admin.homestay.Delete');

    Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
});

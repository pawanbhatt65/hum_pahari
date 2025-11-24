<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'postAdminLogin'])->name('admin.login.post');

Route::group(['prefix' => '/admin', 'middleware' => ['auth.admin']], function () {
    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard');
    })->name('admin.dashboard');
});

<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/homestays', [HomeController::class, 'homestays'])->name('homestays');
Route::get('/homestays/detail', [HomeController::class, 'homeStayDetail'])->name('homeStayDetail');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/details', [HomeController::class, 'productDetail'])->name('productDetail');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/detail', [HomeController::class, 'blogDetail'])->name('blogDetail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/seller.php';
